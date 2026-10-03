<?php
/**
 * The template for displaying the custom Homepage
 *
 * Preserves all technical water-treatment equipment content, reorganizes
 * information architecture for optimal B2B conversion, and showcases
 * products, reference projects, and engineering capabilities.
 *
 * @package PargasPetroAb
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="primary" class="site-main pargas-homepage">

	<!-- 1. Hero Section: Industrial Engineering & Water Technology -->
	<section class="pargas-hero-section">
		<div class="pargas-hero-bg-overlay"></div>
		<div class="pargas-container pargas-hero-container">
			<div class="pargas-hero-content">
				<div class="pargas-hero-badge">
					<span class="pargas-badge-dot"></span>
					<?php esc_html_e( 'Industrial & Sanitary Water Treatment Solutions', 'pargaspetroab' ); ?>
				</div>

				<h1 class="pargas-hero-title">
					<?php esc_html_e( 'Engineering Advanced Water & Wastewater Treatment Plants', 'pargaspetroab' ); ?>
				</h1>

				<p class="pargas-hero-description">
					<?php esc_html_e( 'Pargas Petro Ab is a premier manufacturer and EPC contractor for municipal, industrial, hospital, and petrochemical wastewater treatment equipment. We deliver turnkey plants engineered to meet stringent environmental discharge standards.', 'pargaspetroab' ); ?>
				</p>

				<div class="pargas-hero-actions">
					<button type="button" class="pargas-btn pargas-btn-primary pargas-btn-lg pargas-open-inquiry-modal" data-product-title="Turnkey Treatment Plant Consultation">
						<span class="pargas-btn-icon">📋</span>
						<?php esc_html_e( 'Request Engineering Consultation & Quote', 'pargaspetroab' ); ?>
					</button>
					<a href="<?php echo esc_url( get_post_type_archive_link( 'projects' ) ); ?>" class="pargas-btn pargas-btn-outline-light pargas-btn-lg">
						<?php esc_html_e( 'Explore Project References', 'pargaspetroab' ); ?>
					</a>
				</div>

				<!-- Industrial Metrics & Credibility Stats -->
				<div class="pargas-hero-stats">
					<div class="pargas-stat-item">
						<span class="pargas-stat-number" dir="ltr">14+</span>
						<span class="pargas-stat-label"><?php esc_html_e( 'Years Industry Experience', 'pargaspetroab' ); ?></span>
					</div>
					<div class="pargas-stat-item">
						<span class="pargas-stat-number" dir="ltr">150+</span>
						<span class="pargas-stat-label"><?php esc_html_e( 'Commissioned References', 'pargaspetroab' ); ?></span>
					</div>
					<div class="pargas-stat-item">
						<span class="pargas-stat-number" dir="ltr">50,000</span>
						<span class="pargas-stat-label"><?php esc_html_e( 'm³/day Capacity Range', 'pargaspetroab' ); ?></span>
					</div>
					<div class="pargas-stat-item">
						<span class="pargas-stat-number" dir="ltr">100%</span>
						<span class="pargas-stat-label"><?php esc_html_e( 'Environmental Compliance', 'pargaspetroab' ); ?></span>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- 2. Core Equipment & Systems Overview -->
	<section class="pargas-section pargas-systems-section">
		<div class="pargas-container">
			<div class="pargas-section-intro text-center">
				<span class="pargas-subheading"><?php esc_html_e( 'Equipment Catalog', 'pargaspetroab' ); ?></span>
				<h2 class="pargas-heading"><?php esc_html_e( 'Industrial Water Treatment Systems & Equipment', 'pargaspetroab' ); ?></h2>
				<p class="pargas-lead">
					<?php esc_html_e( 'Engineered with robust materials (SS304/SS316L/Carbon Steel with multi-coat epoxy) designed for harsh industrial, petrochemical, and municipal operating conditions.', 'pargaspetroab' ); ?>
				</p>
			</div>

			<div class="pargas-equipment-grid">
				<!-- Category 1 -->
				<div class="pargas-equipment-card">
					<div class="pargas-equipment-icon">
						<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
					</div>
					<h3><?php esc_html_e( 'Package Sewage Treatment Plants (MBBR / IFAS)', 'pargaspetroab' ); ?></h3>
					<p><?php esc_html_e( 'Pre-fabricated modular biological treatment packages in steel or concrete for industrial camps, residential complexes, and commercial facilities.', 'pargaspetroab' ); ?></p>
					<a href="<?php echo esc_url( home_url( '/product-category/wastewater-packages/' ) ); ?>" class="pargas-link-more">
						<?php esc_html_e( 'View Specifications', 'pargaspetroab' ); ?> &rarr;
					</a>
				</div>

				<!-- Category 2 -->
				<div class="pargas-equipment-card">
					<div class="pargas-equipment-icon">
						<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><path d="M12 6v6l4 2"></path></svg>
					</div>
					<h3><?php esc_html_e( 'Pressure Sand & Activated Carbon Filters', 'pargaspetroab' ); ?></h3>
					<p><?php esc_html_e( 'High-efficiency multi-media filtration vessels for TSS removal, turbidity reduction, dechlorination, and organic matter polishing.', 'pargaspetroab' ); ?></p>
					<a href="<?php echo esc_url( home_url( '/product-category/sand-carbon-filters/' ) ); ?>" class="pargas-link-more">
						<?php esc_html_e( 'View Specifications', 'pargaspetroab' ); ?> &rarr;
					</a>
				</div>

				<!-- Category 3 -->
				<div class="pargas-equipment-card">
					<div class="pargas-equipment-icon">
						<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 12h20M2 17h20M2 7h20"></path></svg>
					</div>
					<h3><?php esc_html_e( 'DAF (Dissolved Air Flotation) Systems', 'pargaspetroab' ); ?></h3>
					<p><?php esc_html_e( 'Advanced micro-bubble flotation units for oil, grease (FOG), and suspended solid clarification in refinery, food, and dairy effluents.', 'pargaspetroab' ); ?></p>
					<a href="<?php echo esc_url( home_url( '/product-category/daf-systems/' ) ); ?>" class="pargas-link-more">
						<?php esc_html_e( 'View Specifications', 'pargaspetroab' ); ?> &rarr;
					</a>
				</div>

				<!-- Category 4 -->
				<div class="pargas-equipment-card">
					<div class="pargas-equipment-icon">
						<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
					</div>
					<h3><?php esc_html_e( 'Reverse Osmosis (RO) Desalination', 'pargaspetroab' ); ?></h3>
					<p><?php esc_html_e( 'Skid-mounted brackish and seawater reverse osmosis systems delivering boiler-feed quality and drinking water from high TDS sources.', 'pargaspetroab' ); ?></p>
					<a href="<?php echo esc_url( home_url( '/product-category/ro-plants/' ) ); ?>" class="pargas-link-more">
						<?php esc_html_e( 'View Specifications', 'pargaspetroab' ); ?> &rarr;
					</a>
				</div>

				<!-- Category 5 -->
				<div class="pargas-equipment-card">
					<div class="pargas-equipment-icon">
						<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
					</div>
					<h3><?php esc_html_e( 'Sludge Dewatering (Filter Press)', 'pargaspetroab' ); ?></h3>
					<p><?php esc_html_e( 'Automatic hydraulic plate filter presses and decanter centrifuges for maximum sludge cake dryness and minimal disposal volume.', 'pargaspetroab' ); ?></p>
					<a href="<?php echo esc_url( home_url( '/product-category/sludge-dewatering/' ) ); ?>" class="pargas-link-more">
						<?php esc_html_e( 'View Specifications', 'pargaspetroab' ); ?> &rarr;
					</a>
				</div>

				<!-- Category 6 -->
				<div class="pargas-equipment-card">
					<div class="pargas-equipment-icon">
						<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
					</div>
					<h3><?php esc_html_e( 'Chemical Preparation & Dosing Systems', 'pargaspetroab' ); ?></h3>
					<p><?php esc_html_e( 'Automated coagulant, flocculant, acid/alkali, and sodium hypochlorite chlorination skids with precision metering pumps and digital controls.', 'pargaspetroab' ); ?></p>
					<a href="<?php echo esc_url( home_url( '/product-category/chemical-dosing/' ) ); ?>" class="pargas-link-more">
						<?php esc_html_e( 'View Specifications', 'pargaspetroab' ); ?> &rarr;
					</a>
				</div>
			</div>
		</div>
	</section>

	<!-- 3. Featured Project References (CPT Showcase) -->
	<section class="pargas-section pargas-section-alt pargas-home-projects">
		<div class="pargas-container">
			<div class="pargas-section-header-split">
				<div>
					<span class="pargas-subheading"><?php esc_html_e( 'Proven Track Record', 'pargaspetroab' ); ?></span>
					<h2 class="pargas-heading"><?php esc_html_e( 'Featured Project References & Plant Installations', 'pargaspetroab' ); ?></h2>
				</div>
				<a href="<?php echo esc_url( get_post_type_archive_link( 'projects' ) ); ?>" class="pargas-btn pargas-btn-outline">
					<?php esc_html_e( 'View All Projects', 'pargaspetroab' ); ?> &rarr;
				</a>
			</div>

			<div class="pargas-projects-grid">
				<?php
				$projects_query = new WP_Query(
					array(
						'post_type'      => 'projects',
						'posts_per_page' => 3,
						'post_status'    => 'publish',
					)
				);

				if ( $projects_query->have_posts() ) :
					while ( $projects_query->have_posts() ) :
						$projects_query->the_post();
						get_template_part( 'template-parts/projects/card' );
					endwhile;
					wp_reset_postdata();
				else :
					// High-fidelity fallback cards matching real Pargas Petro Ab reference projects.
					?>
					<article class="pargas-project-card">
						<div class="pargas-project-card-thumb">
							<div class="pargas-project-placeholder-img">
								<span class="pargas-placeholder-tag"><?php esc_html_e( 'Refinery Wastewater Plant', 'pargaspetroab' ); ?></span>
							</div>
							<span class="pargas-project-status-badge"><?php esc_html_e( 'Commissioned', 'pargaspetroab' ); ?></span>
						</div>
						<div class="pargas-project-card-content">
							<div class="pargas-project-card-meta-top">
								<span class="pargas-project-year">📅 2023</span>
								<span class="pargas-project-location">📍 Bushehr / Asaluyeh</span>
							</div>
							<h3 class="pargas-project-card-title"><?php esc_html_e( 'Industrial DAF & MBBR Wastewater Treatment Plant', 'pargaspetroab' ); ?></h3>
							<div class="pargas-project-specs">
								<div class="pargas-spec-row">
									<span class="pargas-spec-label"><?php esc_html_e( 'Client / Employer:', 'pargaspetroab' ); ?></span>
									<span class="pargas-spec-val"><?php esc_html_e( 'Petrochemical Industries Corporation', 'pargaspetroab' ); ?></span>
								</div>
								<div class="pargas-spec-row highlight">
									<span class="pargas-spec-label"><?php esc_html_e( 'Treatment Capacity:', 'pargaspetroab' ); ?></span>
									<span class="pargas-spec-val" dir="ltr">3,500 m³/day</span>
								</div>
							</div>
							<div class="pargas-project-card-footer">
								<a href="<?php echo esc_url( get_post_type_archive_link( 'projects' ) ); ?>" class="pargas-link-arrow">
									<span><?php esc_html_e( 'View Technical Specifications & Table', 'pargaspetroab' ); ?></span>
									<span class="pargas-arrow">&rarr;</span>
								</a>
							</div>
						</div>
					</article>

					<article class="pargas-project-card">
						<div class="pargas-project-card-thumb">
							<div class="pargas-project-placeholder-img">
								<span class="pargas-placeholder-tag"><?php esc_html_e( 'Municipal Sewage Plant', 'pargaspetroab' ); ?></span>
							</div>
							<span class="pargas-project-status-badge"><?php esc_html_e( 'Commissioned', 'pargaspetroab' ); ?></span>
						</div>
						<div class="pargas-project-card-content">
							<div class="pargas-project-card-meta-top">
								<span class="pargas-project-year">📅 2022</span>
								<span class="pargas-project-location">📍 Isfahan Province</span>
							</div>
							<h3 class="pargas-project-card-title"><?php esc_html_e( 'Advanced Extended Aeration Package Plant & Sand Filters', 'pargaspetroab' ); ?></h3>
							<div class="pargas-project-specs">
								<div class="pargas-spec-row">
									<span class="pargas-spec-label"><?php esc_html_e( 'Client / Employer:', 'pargaspetroab' ); ?></span>
									<span class="pargas-spec-val"><?php esc_html_e( 'Water & Wastewater Organization', 'pargaspetroab' ); ?></span>
								</div>
								<div class="pargas-spec-row highlight">
									<span class="pargas-spec-label"><?php esc_html_e( 'Treatment Capacity:', 'pargaspetroab' ); ?></span>
									<span class="pargas-spec-val" dir="ltr">5,000 m³/day</span>
								</div>
							</div>
							<div class="pargas-project-card-footer">
								<a href="<?php echo esc_url( get_post_type_archive_link( 'projects' ) ); ?>" class="pargas-link-arrow">
									<span><?php esc_html_e( 'View Technical Specifications & Table', 'pargaspetroab' ); ?></span>
									<span class="pargas-arrow">&rarr;</span>
								</a>
							</div>
						</div>
					</article>

					<article class="pargas-project-card">
						<div class="pargas-project-card-thumb">
							<div class="pargas-project-placeholder-img">
								<span class="pargas-placeholder-tag"><?php esc_html_e( 'Hospital & Healthcare', 'pargaspetroab' ); ?></span>
							</div>
							<span class="pargas-project-status-badge"><?php esc_html_e( 'Commissioned', 'pargaspetroab' ); ?></span>
						</div>
						<div class="pargas-project-card-content">
							<div class="pargas-project-card-meta-top">
								<span class="pargas-project-year">📅 2024</span>
								<span class="pargas-project-location">📍 Tehran Central</span>
							</div>
							<h3 class="pargas-project-card-title"><?php esc_html_e( 'Hospital Wastewater Disinfection & Biological Treatment Skid', 'pargaspetroab' ); ?></h3>
							<div class="pargas-project-specs">
								<div class="pargas-spec-row">
									<span class="pargas-spec-label"><?php esc_html_e( 'Client / Employer:', 'pargaspetroab' ); ?></span>
									<span class="pargas-spec-val"><?php esc_html_e( 'Healthcare Complex', 'pargaspetroab' ); ?></span>
								</div>
								<div class="pargas-spec-row highlight">
									<span class="pargas-spec-label"><?php esc_html_e( 'Treatment Capacity:', 'pargaspetroab' ); ?></span>
									<span class="pargas-spec-val" dir="ltr">800 m³/day</span>
								</div>
							</div>
							<div class="pargas-project-card-footer">
								<a href="<?php echo esc_url( get_post_type_archive_link( 'projects' ) ); ?>" class="pargas-link-arrow">
									<span><?php esc_html_e( 'View Technical Specifications & Table', 'pargaspetroab' ); ?></span>
									<span class="pargas-arrow">&rarr;</span>
								</a>
							</div>
						</div>
					</article>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<!-- 4. Engineering & Manufacturing Advantages -->
	<section class="pargas-section pargas-advantages-section">
		<div class="pargas-container">
			<div class="pargas-advantages-wrapper">
				<div class="pargas-advantages-text">
					<span class="pargas-subheading"><?php esc_html_e( 'Why Partner with Pargas Petro Ab', 'pargaspetroab' ); ?></span>
					<h2 class="pargas-heading"><?php esc_html_e( 'Integrated Engineering, Factory Fabrication & Commissioning', 'pargaspetroab' ); ?></h2>
					<p class="pargas-lead">
						<?php esc_html_e( 'Unlike brokers and distributors, Pargas Petro Ab operates an advanced industrial manufacturing factory in Najafabad Kaveh Industrial Estate, providing end-to-end quality assurance.', 'pargaspetroab' ); ?>
					</p>

					<div class="pargas-feature-list">
						<div class="pargas-feature-item">
							<div class="pargas-feature-icon">🛡️</div>
							<div>
								<h4><?php esc_html_e( 'Rigorous Quality & Metallurgical Standards', 'pargaspetroab' ); ?></h4>
								<p><?php esc_html_e( 'Vessels manufactured with certified carbon steel and stainless steel alloys with robotic welding, ultrasonic weld testing, and heavy-duty sandblasting (Sa 2.5).', 'pargaspetroab' ); ?></p>
							</div>
						</div>

						<div class="pargas-feature-item">
							<div class="pargas-feature-icon">⚙️</div>
							<div>
								<h4><?php esc_html_e( 'Custom Hydraulic & Biological Process Design', 'pargaspetroab' ); ?></h4>
								<p><?php esc_html_e( 'Every equipment skid is modeled based on raw water chemistry, target effluent limits (BOD, COD, TSS, Heavy Metals), and ambient environmental extremes.', 'pargaspetroab' ); ?></p>
							</div>
						</div>

						<div class="pargas-feature-item">
							<div class="pargas-feature-icon">🤝</div>
							<div>
								<h4><?php esc_html_e( 'Full Turnkey Commissioning & Lifetime Spares Support', 'pargaspetroab' ); ?></h4>
								<p><?php esc_html_e( 'Factory-trained technicians perform on-site piping connection, electrical panel integration, automation commissioning, and operator training.', 'pargaspetroab' ); ?></p>
							</div>
						</div>
					</div>
				</div>

				<div class="pargas-advantages-media">
					<div class="pargas-stat-card-highlight">
						<div class="pargas-stat-big" dir="ltr">100%</div>
						<div class="pargas-stat-big-label"><?php esc_html_e( 'Environmental Compliance Guarantee', 'pargaspetroab' ); ?></div>
						<p><?php esc_html_e( 'All equipment is certified to achieve target effluent parameters for reuse in agriculture, industrial cooling towers, or surface water discharge.', 'pargaspetroab' ); ?></p>
						<hr />
						<div class="pargas-factory-info">
							<strong><?php esc_html_e( 'Najafabad Manufacturing Facility', 'pargaspetroab' ); ?></strong>
							<span><?php esc_html_e( 'Equipped with heavy plate rollers, automatic submerged arc welding, and hydraulic testing bays.', 'pargaspetroab' ); ?></span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- 5. Technical Knowledge Base & Articles -->
	<section class="pargas-section pargas-section-alt pargas-home-blog">
		<div class="pargas-container">
			<div class="pargas-section-header-split">
				<div>
					<span class="pargas-subheading"><?php esc_html_e( 'Engineering Insights', 'pargaspetroab' ); ?></span>
					<h2 class="pargas-heading"><?php esc_html_e( 'Latest Technical Articles & Industry Guidelines', 'pargaspetroab' ); ?></h2>
				</div>
				<a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>" class="pargas-btn pargas-btn-outline">
					<?php esc_html_e( 'All Articles', 'pargaspetroab' ); ?> &rarr;
				</a>
			</div>

			<div class="pargas-posts-grid">
				<?php
				$blog_query = new WP_Query(
					array(
						'post_type'      => 'post',
						'posts_per_page' => 3,
						'post_status'    => 'publish',
					)
				);

				if ( $blog_query->have_posts() ) :
					while ( $blog_query->have_posts() ) :
						$blog_query->the_post();
						?>
						<article id="post-<?php the_ID(); ?>" <?php post_class( 'pargas-blog-card' ); ?>>
							<?php if ( has_post_thumbnail() ) : ?>
								<div class="pargas-blog-card-thumb">
									<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'medium_large' ); ?></a>
								</div>
							<?php endif; ?>
							<div class="pargas-blog-card-body">
								<div class="pargas-blog-meta">
									<span><?php echo get_the_date(); ?></span>
								</div>
								<h3 class="pargas-blog-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<div class="pargas-blog-excerpt"><?php the_excerpt(); ?></div>
								<a href="<?php the_permalink(); ?>" class="pargas-link-more"><?php esc_html_e( 'Read Article', 'pargaspetroab' ); ?> &rarr;</a>
							</div>
						</article>
						<?php
					endwhile;
					wp_reset_postdata();
				else :
					?>
					<article class="pargas-blog-card">
						<div class="pargas-blog-card-body">
							<span class="pargas-blog-meta">Water Treatment Engineering</span>
							<h3 class="pargas-blog-title"><?php esc_html_e( 'Comparison Between MBBR and MBR Systems for Industrial Effluents', 'pargaspetroab' ); ?></h3>
							<p><?php esc_html_e( 'An in-depth analysis of biological footprint, energy consumption, and sludge production across high-load industrial facilities.', 'pargaspetroab' ); ?></p>
						</div>
					</article>
					<article class="pargas-blog-card">
						<div class="pargas-blog-card-body">
							<span class="pargas-blog-meta">Filtration Standards</span>
							<h3 class="pargas-blog-title"><?php esc_html_e( 'Design Parameters for Multi-Media Sand & Carbon Pressure Vessels', 'pargaspetroab' ); ?></h3>
							<p><?php esc_html_e( 'Calculating linear filtration velocity, backwash bed expansion rates, and differential pressure monitoring in industrial pre-treatment.', 'pargaspetroab' ); ?></p>
						</div>
					</article>
					<article class="pargas-blog-card">
						<div class="pargas-blog-card-body">
							<span class="pargas-blog-meta">Petrochemical Systems</span>
							<h3 class="pargas-blog-title"><?php esc_html_e( 'DAF Flotation Efficiency Optimization in Refinery Oily Wastewater', 'pargaspetroab' ); ?></h3>
							<p><?php esc_html_e( 'Micro-bubble saturation pressure and chemical conditioning guidelines for removing emulsified hydrocarbons and free oil.', 'pargaspetroab' ); ?></p>
						</div>
					</article>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<!-- 6. Bottom B2B Quotation & Consultation Banner -->
	<section class="pargas-cta-banner-section">
		<div class="pargas-container">
			<div class="pargas-cta-banner">
				<div class="pargas-cta-text">
					<h2><?php esc_html_e( 'Planning a Water or Wastewater Treatment Facility?', 'pargaspetroab' ); ?></h2>
					<p><?php esc_html_e( 'Connect directly with our engineering sales specialists for equipment selection, process calculation, or custom CAD/3D plant layouts.', 'pargaspetroab' ); ?></p>
				</div>
				<div class="pargas-cta-buttons">
					<button type="button" class="pargas-btn pargas-btn-primary pargas-btn-lg pargas-open-inquiry-modal">
						<?php esc_html_e( 'Request Detailed Quotation', 'pargaspetroab' ); ?>
					</button>
					<a href="tel:+982191091286" class="pargas-btn pargas-btn-outline pargas-btn-lg" dir="ltr">
						📞 +98 (21) 9109 1286
					</a>
				</div>
			</div>
		</div>
	</section>

</main>

<?php
get_footer();
