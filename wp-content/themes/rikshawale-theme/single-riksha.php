<?php
/**
 * The template for displaying single Riksha posts
 */

get_header(); ?>

<div class="container py-5 my-4">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 
        $thumbnail_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
        if ( ! $thumbnail_url ) {
            $thumbnail_url = 'https://images.unsplash.com/photo-1566838234674-d4508496bf28?auto=format&fit=crop&w=800&q=80';
        }

        // Specs metadata
        $price = get_post_meta( get_the_ID(), '_riksha_price', true );
        $mileage = get_post_meta( get_the_ID(), '_riksha_mileage', true );
        $fuel = get_post_meta( get_the_ID(), '_riksha_fuel', true );
        $transmission = get_post_meta( get_the_ID(), '_riksha_transmission', true );
        $power = get_post_meta( get_the_ID(), '_riksha_power', true );
        $year = get_post_meta( get_the_ID(), '_riksha_year', true );

        // Taxonomies
        $brands = get_the_terms( get_the_ID(), 'riksha_brand' );
        $brand_name = ( $brands && ! is_wp_error( $brands ) ) ? $brands[0]->name : 'Generic';

        $types = get_the_terms( get_the_ID(), 'riksha_type' );
        $type_name = ( $types && ! is_wp_error( $types ) ) ? $types[0]->name : 'Riksha';
    ?>
        <div class="row g-5">
            <!-- Left Column: Featured Image / Gallery -->
            <div class="col-lg-6">
                <img src="<?php echo esc_url( $thumbnail_url ); ?>" class="img-fluid rounded-3 shadow-lg w-100" alt="<?php the_title_attribute(); ?>">
            </div>

            <!-- Right Column: Content Details -->
            <div class="col-lg-6">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <span class="badge bg-danger rounded-pill px-3 py-2 text-uppercase text-white" style="background-color: var(--primary-color) !important;"><?php echo esc_html( $brand_name ); ?></span>
                    <span class="badge bg-dark rounded-pill px-3 py-2 text-uppercase"><?php echo esc_html( $type_name ); ?></span>
                </div>
                
                <h1 class="display-5 fw-bold mb-3 text-dark text-uppercase"><?php the_title(); ?></h1>
                
                <?php if ( $price ) : ?>
                    <h3 class="fw-bold mb-4 text-danger" style="color: var(--primary-color) !important; font-size: 2rem;"><?php echo esc_html( $price ); ?></h3>
                <?php endif; ?>

                <div class="riksha-content mb-5 text-muted lead">
                    <?php the_content(); ?>
                </div>

                <!-- Technical Specifications Grid -->
                <h5 class="fw-bold mb-3 text-uppercase"><i class="fa fa-circle-info text-primary me-2"></i> Technical Specifications</h5>
                <div class="riksha-specs-table mb-5">
                    <!-- Brand -->
                    <div class="row align-items-center">
                        <div class="col-6 riksha-specs-label"><i class="fa fa-copyright me-2 text-primary"></i> Brand / Make</div>
                        <div class="col-6 riksha-specs-value"><?php echo esc_html( $brand_name ); ?></div>
                    </div>
                    <!-- Model Year -->
                    <?php if ( $year ) : ?>
                    <div class="row align-items-center">
                        <div class="col-6 riksha-specs-label"><i class="fa fa-calendar me-2 text-primary"></i> Model Year</div>
                        <div class="col-6 riksha-specs-value"><?php echo esc_html( $year ); ?></div>
                    </div>
                    <?php endif; ?>
                    <!-- Fuel Type -->
                    <?php if ( $fuel ) : ?>
                    <div class="row align-items-center">
                        <div class="col-6 riksha-specs-label"><i class="fa fa-gas-pump me-2 text-primary"></i> Fuel / Power Type</div>
                        <div class="col-6 riksha-specs-value"><?php echo esc_html( $fuel ); ?></div>
                    </div>
                    <?php endif; ?>
                    <!-- Range / Mileage -->
                    <?php if ( $mileage ) : ?>
                    <div class="row align-items-center">
                        <div class="col-6 riksha-specs-label"><i class="fa fa-gauge me-2 text-primary"></i> Range / Mileage</div>
                        <div class="col-6 riksha-specs-value"><?php echo esc_html( $mileage ); ?></div>
                    </div>
                    <?php endif; ?>
                    <!-- Transmission -->
                    <?php if ( $transmission ) : ?>
                    <div class="row align-items-center">
                        <div class="col-6 riksha-specs-label"><i class="fa fa-cogs me-2 text-primary"></i> Transmission</div>
                        <div class="col-6 riksha-specs-value"><?php echo esc_html( $transmission ); ?></div>
                    </div>
                    <?php endif; ?>
                    <!-- Engine/Motor Power -->
                    <?php if ( $power ) : ?>
                    <div class="row align-items-center">
                        <div class="col-6 riksha-specs-label"><i class="fa fa-bolt me-2 text-primary"></i> Motor / Engine Power</div>
                        <div class="col-6 riksha-specs-value"><?php echo esc_html( $power ); ?></div>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Booking Panel -->
                <div class="card border-0 rounded-3 p-4 shadow-sm" style="background-color: var(--light-color); border-top: 4px solid var(--primary-color) !important;">
                    <h5 class="fw-bold mb-2 uppercase">Interested in booking?</h5>
                    <p class="small text-muted mb-4">Contact our dealership representatives directly to schedule a showroom visit, test drive, or finance consultation.</p>
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <a href="tel:<?php echo esc_attr( get_theme_mod( 'topbar_phone', '' ) ); ?>" class="btn btn-danger btn-lg fw-bold w-100 py-3 uppercase" style="background-color: var(--primary-color); border-color: var(--primary-color); font-size: 0.9rem;"><i class="fa fa-phone me-2"></i> Call Showroom</a>
                        </div>
                        <div class="col-sm-6">
                            <a href="mailto:<?php echo esc_attr( get_theme_mod( 'topbar_email', '' ) ); ?>" class="btn btn-outline-dark btn-lg fw-bold w-100 py-3 uppercase" style="font-size: 0.9rem;"><i class="fa fa-envelope me-2"></i> Email Inquiry</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endwhile; endif; ?>
</div>

<?php get_footer(); ?>
