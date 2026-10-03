/**
 * Pargas Petro Ab - Admin Technical Table Builder & Excel Import Script
 *
 * Provides dynamic row/column management and zero-dependency Excel (.xlsx) importing.
 *
 * @package PargasPetroAb
 */

document.addEventListener('DOMContentLoaded', () => {
  const tableApp = document.getElementById('pargas-table-builder-app');
  if (!tableApp) return;

  const gridTable = document.getElementById('pargas-admin-grid');
  const gridHeaders = document.getElementById('pargas-admin-grid-headers');
  const gridBody = document.getElementById('pargas-admin-grid-body');
  const addRowBtn = document.getElementById('pargas-add-row-btn');
  const addColBtn = document.getElementById('pargas-add-col-btn');
  const fileInput = document.getElementById('pargas-excel-file-input');
  const spinner = document.getElementById('pargas-excel-import-spinner');
  const jsonTextarea = document.getElementById('pargas_technical_table_json');

  /**
   * Synchronize DOM table state into the hidden JSON textarea.
   */
  function syncJsonData() {
    const columns = [];
    const headerInputs = gridHeaders.querySelectorAll('.pargas-col-title-input');
    headerInputs.forEach((input) => {
      columns.push(input.value.trim());
    });

    const rows = [];
    const tableRows = gridBody.querySelectorAll('.pargas-data-row');
    tableRows.forEach((tr) => {
      const rowCells = [];
      const cellInputs = tr.querySelectorAll('.pargas-cell-input');
      cellInputs.forEach((cInput) => {
        rowCells.push(cInput.value.trim());
      });
      rows.push(rowCells);
    });

    const dataObj = {
      columns: columns,
      rows: rows,
    };

    if (jsonTextarea) {
      jsonTextarea.value = JSON.stringify(dataObj);
    }
  }

  /**
   * Renumber the first column (#) of each row.
   */
  function renumberRows() {
    const tableRows = gridBody.querySelectorAll('.pargas-data-row');
    tableRows.forEach((tr, index) => {
      tr.setAttribute('data-row-index', index);
      const numCell = tr.querySelector('.pargas-row-num');
      if (numCell) {
        numCell.textContent = index + 1;
      }
    });
  }

  /**
   * Add a new data row.
   */
  if (addRowBtn) {
    addRowBtn.addEventListener('click', () => {
      const colCount = gridHeaders.querySelectorAll('.pargas-col-header').length;
      const tr = document.createElement('tr');
      tr.className = 'pargas-data-row';

      let html = '<td class="pargas-row-num"></td>';
      for (let c = 0; c < colCount; c++) {
        html += `<td class="pargas-data-cell" data-col-index="${c}">
          <input type="text" class="pargas-cell-input" value="" />
        </td>`;
      }
      html += `<td class="pargas-action-col">
        <button type="button" class="pargas-remove-row-btn button-link-delete" title="Delete row">
          <span class="dashicons dashicons-trash"></span>
        </button>
      </td>`;

      tr.innerHTML = html;
      gridBody.appendChild(tr);
      renumberRows();
      syncJsonData();
    });
  }

  /**
   * Add a new column.
   */
  if (addColBtn) {
    addColBtn.addEventListener('click', () => {
      const actionTh = gridHeaders.querySelector('.pargas-action-col');
      const newColIndex = gridHeaders.querySelectorAll('.pargas-col-header').length;

      // Add Header
      const th = document.createElement('th');
      th.className = 'pargas-col-header';
      th.setAttribute('data-col-index', newColIndex);
      th.innerHTML = `
        <div class="pargas-header-wrap">
          <input type="text" class="pargas-col-title-input" value="Column ${newColIndex + 1}" />
          <button type="button" class="pargas-remove-col-btn" title="Remove column">&times;</button>
        </div>
      `;
      gridHeaders.insertBefore(th, actionTh);

      // Add Cell to each existing row
      const tableRows = gridBody.querySelectorAll('.pargas-data-row');
      tableRows.forEach((tr) => {
        const actionTd = tr.querySelector('.pargas-action-col');
        const td = document.createElement('td');
        td.className = 'pargas-data-cell';
        td.setAttribute('data-col-index', newColIndex);
        td.innerHTML = '<input type="text" class="pargas-cell-input" value="" />';
        tr.insertBefore(td, actionTd);
      });

      syncJsonData();
    });
  }

  /**
   * Event Delegation for Removal & Input Changes.
   */
  tableApp.addEventListener('click', (e) => {
    // Remove Row
    const removeRowBtn = e.target.closest('.pargas-remove-row-btn');
    if (removeRowBtn) {
      e.preventDefault();
      const tr = removeRowBtn.closest('.pargas-data-row');
      if (tr) {
        tr.remove();
        renumberRows();
        syncJsonData();
      }
      return;
    }

    // Remove Column
    const removeColBtn = e.target.closest('.pargas-remove-col-btn');
    if (removeColBtn) {
      e.preventDefault();
      if (!confirm((window.pargasAdminTable && window.pargasAdminTable.confirmRemove) || 'Remove this column?')) {
        return;
      }
      const th = removeColBtn.closest('.pargas-col-header');
      if (th) {
        const colIndex = Array.from(gridHeaders.children).indexOf(th);
        th.remove();

        const tableRows = gridBody.querySelectorAll('.pargas-data-row');
        tableRows.forEach((tr) => {
          if (tr.children[colIndex]) {
            tr.children[colIndex].remove();
          }
        });
        syncJsonData();
      }
    }
  });

  // Listen to input typing to auto-sync JSON.
  tableApp.addEventListener('input', (e) => {
    if (e.target.matches('.pargas-col-title-input') || e.target.matches('.pargas-cell-input')) {
      syncJsonData();
    }
  });

  /**
   * Excel Import Handler (.xlsx)
   */
  if (fileInput) {
    fileInput.addEventListener('change', () => {
      const file = fileInput.files[0];
      if (!file) return;

      if (!file.name.endsWith('.xlsx')) {
        alert('Please choose an Excel spreadsheet with the .xlsx extension.');
        fileInput.value = '';
        return;
      }

      if (spinner) spinner.classList.add('is-active');

      const formData = new FormData();
      formData.append('action', 'pargas_import_excel_table');
      formData.append('nonce', window.pargasAdminTable ? window.pargasAdminTable.nonce : '');
      formData.append('excel_file', file);

      fetch(window.pargasAdminTable ? window.pargasAdminTable.ajaxUrl : '/wp-admin/admin-ajax.php', {
        method: 'POST',
        body: formData,
      })
        .then((res) => res.json())
        .then((res) => {
          if (spinner) spinner.classList.remove('is-active');
          fileInput.value = '';

          if (res.success && res.data.table) {
            renderFullTableFromData(res.data.table);
            syncJsonData();
          } else {
            alert(res.data && res.data.message ? res.data.message : 'Error importing Excel spreadsheet.');
          }
        })
        .catch(() => {
          if (spinner) spinner.classList.remove('is-active');
          fileInput.value = '';
          alert('Network or server error during spreadsheet import.');
        });
    });
  }

  /**
   * Re-render table completely from imported data object { columns: [], rows: [] }
   */
  function renderFullTableFromData(data) {
    if (!data.columns || !data.rows) return;

    // Build Headers
    let headerHtml = '<th class="pargas-row-num">#</th>';
    data.columns.forEach((colTitle, idx) => {
      headerHtml += `
        <th class="pargas-col-header" data-col-index="${idx}">
          <div class="pargas-header-wrap">
            <input type="text" class="pargas-col-title-input" value="${escapeHtml(colTitle)}" />
            <button type="button" class="pargas-remove-col-btn" title="Remove column">&times;</button>
          </div>
        </th>
      `;
    });
    headerHtml += '<th class="pargas-action-col">Action</th>';
    gridHeaders.innerHTML = headerHtml;

    // Build Body Rows
    let bodyHtml = '';
    data.rows.forEach((row, rIdx) => {
      bodyHtml += `<tr class="pargas-data-row" data-row-index="${rIdx}">
        <td class="pargas-row-num">${rIdx + 1}</td>`;
      data.columns.forEach((unused, cIdx) => {
        const val = row[cIdx] || '';
        bodyHtml += `<td class="pargas-data-cell" data-col-index="${cIdx}">
          <input type="text" class="pargas-cell-input" value="${escapeHtml(val)}" />
        </td>`;
      });
      bodyHtml += `<td class="pargas-action-col">
        <button type="button" class="pargas-remove-row-btn button-link-delete" title="Delete row">
          <span class="dashicons dashicons-trash"></span>
        </button>
      </td></tr>`;
    });
    gridBody.innerHTML = bodyHtml;
  }

  function escapeHtml(text) {
    return text
      .replace(/&/g, '&amp;')
      .replace(/</g, '&lt;')
      .replace(/>/g, '&gt;')
      .replace(/"/g, '&quot;')
      .replace(/'/g, '&#039;');
  }
});
