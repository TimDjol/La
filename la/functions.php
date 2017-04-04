<?php
function custom_scripts() {
    wp_register_style('font-style', 'http://fonts.googleapis.com/css?family=Oswald:400,300');
    wp_enqueue_style( 'whitesquare-style', get_stylesheet_uri());
    wp_enqueue_style( 'font-style');
    wp_enqueue_style('font-awesome.min', get_template_directory_uri().'/css/font-awesome.min.css');
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.css');
    wp_register_script('bootstrap', get_template_directory_uri() .'/js/bootstrap.min.js', array('jquery'), false, true);
    wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js');
    wp_enqueue_style('style', get_template_directory_uri().'/css/main.min.css');
    //('html5-shim', 'http://html5shim.googlecode.com/svn/trunk/html5.js');
    //wp_enqueue_script('html5-shim');
    wp_enqueue_script('bootstrap');
    wp_enqueue_script('jquery');
    wp_enqueue_script('PageScroll2id.min', get_template_directory_uri().'/js/PageScroll2id.min.js');
    wp_enqueue_script('commonco', get_template_directory_uri().'/js/commonco.js');

}
add_action('wp_enqueue_scripts', 'custom_scripts');

function my_acf_google_map_api( $api ){
	
	$api['key'] = 'AIzaSyD9MPC5dK1XSrlrl2Jez5vsIWfEDoxxtGQ';
	
	return $api;
	
}

add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');



add_action( 'widgets_init', 'register_my_widgets' );
function register_my_widgets(){
	register_sidebar( array(
		'name'          => sprintf(__('Sidebar %d'), $i ),
		'id'            => "sidebar-$i",
		'description'   => '',
		'class'         => '',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => "</li>\n",
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => "</h2>\n",
	) );
}

add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

// Bredcrumbs
function kama_breadcrumbs( $sep = ' &nbsp;<i class="fa fa-angle-right" aria-hidden="true"></i>&nbsp; ', $l10n = array(), $args = array() ){
	$kb = new Kama_Breadcrumbs;
	echo $kb->get_crumbs( $sep, $l10n, $args );
}

class Kama_Breadcrumbs {

	public $arg;

	// localization
	static $l10n = array(
		'home'       => '<i class="fa fa-home"></i>',
		'paged'      => 'PAGE %d',
		'_404'       => 'ERROR 404',
		'search'     => 'Search results for - <b>%s</b>',
		'author'     => 'Autor arhive: <b>%s</b>',
		'year'       => 'Arhive for <b>%d</b> year',
		'month'      => 'Arhive for: <b>%s</b>',
		'day'        => '',
		'attachment' => 'MEDIA: %s',
		'tag'        => 'Entries by Tag: <b>%s</b>',
		'tax_tag'    => '%1$s for "%2$s" by teg: <b>%3$s</b>',
		
	);

	// default options
	static $args = array(
		'on_front_page'   => true,  
		'show_post_title' => true,  
		'show_term_title' => true,  
		'title_patt'      => '<span class="kb_title">%s</span>', 
		'last_sep'        => true,  
		'markup'          => 'schema.org', 
										  
										   
		'priority_tax'    => array('category'), 
		'priority_terms'  => array(), 
									  
									  
									 
		'nofollow' => false, 

		// служебные
		'sep'             => '',
		'linkpatt'        => '',
		'pg_end'          => '',
	);

	function get_crumbs( $sep, $l10n, $args ){
		global $post, $wp_query, $wp_post_types;

		self::$args['sep'] = $sep;

		// Фильтрует дефолты и сливает
		$loc = (object) array_merge( apply_filters('kama_breadcrumbs_default_loc', self::$l10n ), $l10n );
		$arg = (object) array_merge( apply_filters('kama_breadcrumbs_default_args', self::$args ), $args );

		$arg->sep = '<span class="kb_sep">'. $arg->sep .'</span>'; // дополним

		// упростим
		$sep = & $arg->sep;
		$this->arg = & $arg;

		// микроразметка ---
		if(1){
			$mark = & $arg->markup;

			// Разметка по умолчанию
			if( ! $mark ) $mark = array(
				'wrappatt'  => '<div class="kama_breadcrumbs">%s</div>',
				'linkpatt'  => '<a href="%s">%s</a>',
				'sep_after' => '',
			);
			// rdf
			elseif( $mark === 'rdf.data-vocabulary.org' ) $mark = array(
				'wrappatt'   => '<div class="kama_breadcrumbs" prefix="v: http://rdf.data-vocabulary.org/#">%s</div>',
				'linkpatt'   => '<span typeof="v:Breadcrumb"><a href="%s" rel="v:url" property="v:title">%s</a>',
				'sep_after'  => '</span>', // закрываем span после разделителя!
			);
			// schema.org
			elseif( $mark === 'schema.org' ) $mark = array(
				'wrappatt'   => '<div class="kama_breadcrumbs" itemscope itemtype="http://schema.org/BreadcrumbList">%s</div>',
				'linkpatt'   => '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="%s" itemprop="item"><span itemprop="name">%s</span></a></span>',
				'sep_after'  => '',
			);

			elseif( ! is_array($mark) )
				die( __CLASS__ .': "markup" parameter must be array...');

			$wrappatt  = $mark['wrappatt'];
			$arg->linkpatt  = $arg->nofollow ? str_replace('<a ','<a rel="nofollow"', $mark['linkpatt']) : $mark['linkpatt'];
			$arg->sep      .= $mark['sep_after']."\n";
		}

		$linkpatt = $arg->linkpatt; // упростим

		$q_obj = get_queried_object();

		// может это архив пустой таксы?
		$ptype = null;
		if( empty($post) ){
			if( isset($q_obj->taxonomy) )
				$ptype = & $wp_post_types[ get_taxonomy($q_obj->taxonomy)->object_type[0] ];
		}
		else $ptype = & $wp_post_types[ $post->post_type ];

		// paged
		$arg->pg_end = '';
		if( ($paged_num = get_query_var('paged')) || ($paged_num = get_query_var('page')) )
			$arg->pg_end = $sep . sprintf( $loc->paged, (int) $paged_num );

		$pg_end = $arg->pg_end; // упростим

		// ну, с богом...
		$out = '';

		if( is_front_page() ){
			return $arg->on_front_page ? sprintf( $wrappatt, ( $paged_num ? sprintf($linkpatt, get_home_url(), $loc->home) . $pg_end : $loc->home ) ) : '';
		}
		// страница записей, когда для главной установлена отдельная страница.
		elseif( is_home() ) {
			$out = $paged_num ? ( sprintf( $linkpatt, get_permalink($q_obj), esc_html($q_obj->post_title) ) . $pg_end ) : esc_html($q_obj->post_title);
		}
		elseif( is_404() ){
			$out = $loc->_404;
		}
		elseif( is_search() ){
			$out = sprintf( $loc->search, esc_html( $GLOBALS['s'] ) );
		}
		elseif( is_author() ){
			$tit = sprintf( $loc->author, esc_html($q_obj->display_name) );
			$out = ( $paged_num ? sprintf( $linkpatt, get_author_posts_url( $q_obj->ID, $q_obj->user_nicename ) . $pg_end, $tit ) : $tit );
		}
		elseif( is_year() || is_month() || is_day() ){
			$y_url  = get_year_link( $year = get_the_time('Y') );

			if( is_year() ){
				$tit = sprintf( $loc->year, $year );
				$out = ( $paged_num ? sprintf($linkpatt, $y_url, $tit) . $pg_end : $tit );
			}
			// month day
			else {
				$y_link = sprintf( $linkpatt, $y_url, $year);
				$m_url  = get_month_link( $year, get_the_time('m') );

				if( is_month() ){
					$tit = sprintf( $loc->month, get_the_time('F') );
					$out = $y_link . $sep . ( $paged_num ? sprintf( $linkpatt, $m_url, $tit ) . $pg_end : $tit );
				}
				elseif( is_day() ){
					$m_link = sprintf( $linkpatt, $m_url, get_the_time('F'));
					$out = $y_link . $sep . $m_link . $sep . get_the_time('l');
				}
			}
		}
		// Древовидные записи
		elseif( is_singular() && $ptype->hierarchical ){
			$out = $this->_add_title( $this->_page_crumbs($post), $post );
		}
		// Таксы, плоские записи и вложения
		else {
			$term = $q_obj; // таксономии

			// определяем термин для записей (включая вложения attachments)
			if( is_singular() ){
				// изменим $post, чтобы определить термин родителя вложения
				if( is_attachment() && $post->post_parent ){
					$save_post = $post; // сохраним
					$post = get_post($post->post_parent);
				}

				// учитывает если вложения прикрепляются к таксам древовидным - все бывает :)
				$taxonomies = get_object_taxonomies( $post->post_type );
				// оставим только древовидные и публичные, мало ли...
				$taxonomies = array_intersect( $taxonomies, get_taxonomies( array('hierarchical' => true, 'public' => true) ) );

				if( $taxonomies ){
					// сортируем по приоритету
					if( ! empty($arg->priority_tax) ){
						usort( $taxonomies, function($a,$b)use($arg){
							$a_index = array_search($a, $arg->priority_tax);
							if( $a_index === false ) $a_index = 9999999;

							$b_index = array_search($b, $arg->priority_tax);
							if( $b_index === false ) $b_index = 9999999;

							return ( $b_index === $a_index ) ? 0 : ( $b_index < $a_index ? 1 : -1 ); // меньше индекс - выше
						} );
					}

					// пробуем получить термины, в порядке приоритета такс
					foreach( $taxonomies as $taxname ){
						if( $terms = get_the_terms( $post->ID, $taxname ) ){
							// проверим приоритетные термины для таксы
							$prior_terms = & $arg->priority_terms[ $taxname ];
							if( $prior_terms && count($terms) > 2 ){
								foreach( (array) $prior_terms as $term_id ){
									$filter_field = is_numeric($term_id) ? 'term_id' : 'slug';
									$_terms = wp_list_filter( $terms, array($filter_field=>$term_id) );

									if( $_terms ){
										$term = array_shift( $_terms );
										break;
									}
								}
							}
							else
								$term = array_shift( $terms );

							break;
						}
					}
				}

				if( isset($save_post) ) $post = $save_post; // вернем обратно (для вложений)
			}

			// вывод

			// все виды записей с терминами или термины
			if( $term && isset($term->term_id) ){
				$term = apply_filters('kama_breadcrumbs_term', $term );

				// attachment
				if( is_attachment() ){
					if( ! $post->post_parent )
						$out = sprintf( $loc->attachment, esc_html($post->post_title) );
					else {
						if( ! $out = apply_filters('attachment_tax_crumbs', '', $term, $this ) ){
							$_crumbs    = $this->_tax_crumbs( $term, 'self' );
							$parent_tit = sprintf( $linkpatt, get_permalink($post->post_parent), get_the_title($post->post_parent) );
							$_out = implode( $sep, array($_crumbs, $parent_tit) );
							$out = $this->_add_title( $_out, $post );
						}
					}
				}
				// single
				elseif( is_single() ){
					if( ! $out = apply_filters('post_tax_crumbs', '', $term, $this ) ){
						$_crumbs = $this->_tax_crumbs( $term, 'self' );
						$out = $this->_add_title( $_crumbs, $post );
					}
				}
				// не древовидная такса (метки)
				elseif( ! is_taxonomy_hierarchical($term->taxonomy) ){
					// метка
					if( is_tag() )
						$out = $this->_add_title('', $term, sprintf( $loc->tag, esc_html($term->name) ) );
					// такса
					elseif( is_tax() ){
						$post_label = $ptype->labels->name;
						$tax_label = $GLOBALS['wp_taxonomies'][ $term->taxonomy ]->labels->name;
						$out = $this->_add_title('', $term, sprintf( $loc->tax_tag, $post_label, $tax_label, esc_html($term->name) ) );
					}
				}
				// древовидная такса (рибрики)
				else {
					if( ! $out = apply_filters('term_tax_crumbs', '', $term, $this ) ){
						$_crumbs = $this->_tax_crumbs( $term, 'parent' );
						$out = $this->_add_title( $_crumbs, $term, esc_html($term->name) );                     
					}
				}
			}
			// влоежния от записи без терминов
			elseif( is_attachment() ){
				$parent = get_post($post->post_parent);
				$parent_link = sprintf( $linkpatt, get_permalink($parent), esc_html($parent->post_title) );
				$_out = $parent_link;

				// вложение от записи древовидного типа записи
				if( is_post_type_hierarchical($parent->post_type) ){
					$parent_crumbs = $this->_page_crumbs($parent);
					$_out = implode( $sep, array( $parent_crumbs, $parent_link ) );
				}

				$out = $this->_add_title( $_out, $post );
			}
			// записи без терминов
			elseif( is_singular() ){
				$out = $this->_add_title( '', $post );
			}
		}

		// замена ссылки на архивную страницу для типа записи
		$home_after = apply_filters('kama_breadcrumbs_home_after', '', $linkpatt, $sep, $ptype );

		if( '' === $home_after ){
			// Ссылка на архивную страницу типа записи для: отдельных страниц этого типа; архивов этого типа; таксономий связанных с этим типом.
			if( $ptype && $ptype->has_archive && ! in_array( $ptype->name, array('post','page','attachment') )
				&& ( is_post_type_archive() || is_singular() || (is_tax() && in_array($term->taxonomy, $ptype->taxonomies)) )
			){
				$pt_title = $ptype->labels->name;

				// первая страница архива типа записи
				if( is_post_type_archive() && ! $paged_num )
					$home_after = $pt_title;
				// singular, paged post_type_archive, tax
				else{
					$home_after = sprintf( $linkpatt, get_post_type_archive_link($ptype->name), $pt_title );

					$home_after .= ( ($paged_num && ! is_tax()) ? $pg_end : $sep ); // пагинация
				}
			}
		}

		$before_out = sprintf( $linkpatt, home_url(), $loc->home ) . ( $home_after ? $sep.$home_after : ($out ? $sep : '') );

		$out = apply_filters('kama_breadcrumbs_pre_out', $out, $sep, $loc, $arg );

		$out = sprintf( $wrappatt, $before_out . $out );

		return apply_filters('kama_breadcrumbs', $out, $sep, $loc, $arg );
	}

	function _page_crumbs( $post ){
		$parent = $post->post_parent;

		$crumbs = array();
		while( $parent ){
			$page = get_post( $parent );
			$crumbs[] = sprintf( $this->arg->linkpatt, get_permalink($page), esc_html($page->post_title) );
			$parent = $page->post_parent;
		}

		return implode( $this->arg->sep, array_reverse($crumbs) );
	}

	function _tax_crumbs( $term, $start_from = 'self' ){
		$termlinks = array();
		$term_id = ($start_from === 'parent') ? $term->parent : $term->term_id;
		while( $term_id ){
			$term       = get_term( $term_id, $term->taxonomy );
			$termlinks[] = sprintf( $this->arg->linkpatt, get_term_link($term), esc_html($term->name) );
			$term_id    = $term->parent;
		}

		if( $termlinks )
			$vp_term = array_reverse($termlinks);
			return $vp_term[0] /*. $this->arg->sep*/;
		return '';
	}

	// добалвяет заголовок к переданному тексту, с учетом всех опций. Добавляет разделитель в начало, если надо.
	function _add_title( $add_to, $obj, $term_title = '' ){
		$arg = & $this->arg; // упростим...
		$title = $term_title ? $term_title : esc_html($obj->post_title); // $term_title чиститься отдельно, теги моугт быть...
		$show_title = $term_title ? $arg->show_term_title : $arg->show_post_title;

		// пагинация
		if( $arg->pg_end ){
			$link = $term_title ? get_term_link($obj) : get_permalink($obj);
			$add_to .= ($add_to ? $arg->sep : '') . sprintf( $arg->linkpatt, $link, $title ) . $arg->pg_end;
		}
		// дополняем - ставим sep
		elseif( $add_to ){
			if( $show_title )
				$add_to .= $arg->sep . sprintf( $arg->title_patt, $title );
			elseif( $arg->last_sep )
				$add_to .= $arg->sep;
		}
		// sep будет потом...
		elseif( $show_title )
			$add_to = sprintf( $arg->title_patt, $title );

		return $add_to;
	}

}

	register_sidebar(array(
					'name' => 'МЕсто для Фильтра',
					'id' => 'e_filter',
					'before_widget' => '',
					'after_widget' => ''));

	/*** Pagination **/
function wp_corenavi(){
	global $wp_query, $wp_rewrite;
	$pages = '';
	$max = $wp_query->max_num_pages;
	if (!$current = get_query_var('paged')) $current = 1;
	$a['base'] = str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999)));
	$a['total'] = $max;
	$a['current'] = $current;

	$total = 0; //1 - выводить текст "Страница N из N", 0 - не выводить
	$a['mid_size'] = 2; //сколько ссылок показывать слева и справа от текущей
	$a['end_size'] = 1; //сколько ссылок показывать в начале и в конце
	$a['prev_text'] = '<'; //текст ссылки "Предыдущая страница"
	$a['next_text'] = '>'; //текст ссылки "Следующая страница"

	if ($max > 1) echo '<div class="pager">';
	if ($total == 1 && $max > 1) $pages = '<span class="pages">Страница ' . $current . ' из ' . $max . '</span>'."\r\n";
	echo $pages . paginate_links($a);
	if ($max > 1) echo '</div>';
}
	

	/**
 * Plugin Name: Auto-update Plugins and Themes
 */
add_filter( 'auto_update_theme', '__return_false' );
add_filter( 'auto_update_plugin', '__return_false' );

// Register Custom Navigation Walker
 require_once('wp_bootstrap_navwalker.php');
 
 register_nav_menus( array(
     'main' => __( 'Main Menu', 'example' ),
     'cat' => __( 'Cat Menu', 'example' ),
 ) );

add_action('customize_register', function($customizer){

	//Контакты
	$customizer->add_section( 'examcont', array('title' => 'Телефон и график работы','description' => '','priority' => 10,));
	$customizer->add_setting('logo');
    $customizer->add_setting( 'tel', array('default' => ' 0777111444, 0555111000'));
	$customizer->add_setting( 'graf', array('default' => 'С 10:00 ДО 19:00'));
	$customizer->add_control( new WP_Customize_Image_Control($customizer,'logo', array('label' => 'Логотип','section' => 'examcont','settings' => 'logo')));
	$customizer->add_control( 'tel', array('label' => 'Телефон','section' => 'examcont','type' => 'text',));
	$customizer->add_control( 'graf', array('label' => 'График','section' => 'examcont','type' => 'text',));
	
	//Главный фон
	$customizer->add_section( 'slider', array('title' => 'Главный фон','description' => '','priority' => 11,));
	$customizer->add_setting('slidimg');
    $customizer->add_setting( 'tit', array('default' => ' '));
	$customizer->add_setting( 'descrip', array('default' => ' '));
	$customizer->add_control( new WP_Customize_Image_Control($customizer,'slidimg', array('label' => 'Изображение','section' => 'slider','settings' => 'slidimg')));
	$customizer->add_control( 'tit', array('label' => 'Заголовок','section' => 'slider','type' => 'text',));
	$customizer->add_control( 'descrip', array('label' => 'Описание','section' => 'slider','type' => 'textarea',));
	
	//Footer
	$customizer->add_section( 'tad', array('title' => 'Адреса в Таджикистане','description' => '','priority' => 12,));
    $customizer->add_setting( 'tad_adres1', array('default' => ' '));
	$customizer->add_setting( 'tad_adres2', array('default' => ' '));
	$customizer->add_control( 'tad_adres1', array('label' => 'Адрес1','section' => 'tad','type' => 'text',));
	$customizer->add_control( 'tad_adres2', array('label' => 'Адрес2','section' => 'tad','type' => 'text',));
	
	$customizer->add_section( 'kg', array('title' => 'Адреса в Кыргызстане','description' => '','priority' => 13,));
    $customizer->add_setting( 'kg_adres1', array('default' => ' '));
	$customizer->add_setting( 'kg_adres2', array('default' => ' '));
	$customizer->add_setting( 'kg_adres3', array('default' => ' '));
	$customizer->add_control( 'kg_adres1', array('label' => 'Адрес1','section' => 'kg','type' => 'text',));
	$customizer->add_control( 'kg_adres2', array('label' => 'Адрес2','section' => 'kg','type' => 'text',));
	$customizer->add_control( 'kg_adres3', array('label' => 'Адрес2','section' => 'kg','type' => 'text',));
	
	$customizer->add_section( 'biw', array('title' => 'Адреса в Бишкеке','description' => '','priority' => 14,));
    $customizer->add_setting( 'biw_adres1', array('default' => ' '));
	$customizer->add_setting( 'biw_adres2', array('default' => ' '));
	$customizer->add_setting( 'biw_adres3', array('default' => ' '));
	$customizer->add_control( 'biw_adres1', array('label' => 'Адрес1','section' => 'biw','type' => 'text',));
	$customizer->add_control( 'biw_adres2', array('label' => 'Адрес2','section' => 'biw','type' => 'text',));
	$customizer->add_control( 'biw_adres3', array('label' => 'Адрес2','section' => 'biw','type' => 'text',));
	
	
	//Id категории для каруселя
	$customizer->add_section( 'idcat-link', array('title' => 'Идентификатор категории и ссылка для каруселей на главном','description' => '','priority' => 15,));

	$customizer->add_setting( 'catsl1', array('default' => '14'));
	$customizer->add_control( 'catsl1', array('label' => 'ID категории первый каресель','section' => 'idcat-link','type' => 'text',));
	$customizer->add_setting( 'catsll1', array('default' => '#'));
	$customizer->add_control( 'catsll1', array('label' => 'Ссылка для кнопки показать еще 1','section' => 'idcat-link','type' => 'text',));

	$customizer->add_setting( 'catsl2', array('default' => '15'));
	$customizer->add_control( 'catsl2', array('label' => 'ID категории второй карусель','section' => 'idcat-link','type' => 'text',));
	$customizer->add_setting( 'catsll2', array('default' => '#'));
	$customizer->add_control( 'catsll2', array('label' => 'Ссылка для кнопки показать еще 2','section' => 'idcat-link','type' => 'text',));


});



//* Активируем поддержку шрифта Font Awesome
add_action( 'wp_enqueue_scripts', 'enqueue_font_awesome' );
function enqueue_font_awesome() {

	wp_enqueue_style( 'font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css' );

}

/**
 * Помещаем иконку корзины с количеством товаров и общей стоимостью в меню навигации.
 *
 * Источник: http://wordpress.org/plugins/woocommerce-menu-bar-cart/
 */
add_filter('wp_nav_menu_items','sk_wcmenucart', 10, 2);
function sk_wcmenucart($menu, $args) {

	// Проверяем, установлен ли и активирован плагин WooCommerce и добавляем новый элемент в меню, назначенному основным меню навигации
	if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) || 'primary' !== $args->theme_location )
		return $menu;

	ob_start();
		global $woocommerce;
		$viewing_cart = __('View your shopping cart', 'your-theme-slug');
		$start_shopping = __('Start shopping', 'your-theme-slug');
		$cart_url = $woocommerce->cart->get_cart_url();
		$shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) );
		$cart_contents_count = $woocommerce->cart->cart_contents_count;
		$cart_contents = sprintf(_n('%d item', '%d items', $cart_contents_count, 'your-theme-slug'), $cart_contents_count);
		$cart_total = $woocommerce->cart->get_cart_total();
		// Раскомментируйте строку ниже для того, чтобы скрыть иконку корзины в меню, когда нет добавленных товаров в корзине.
		// if ( $cart_contents_count > 0 ) {
			if ($cart_contents_count == 0) {
				$menu_item = '<li class="right"><a class="wcmenucart-contents" href="'. $shop_page_url .'" title="'. $start_shopping .'">';
			} else {
				$menu_item = '<li class="right"><a class="wcmenucart-contents" href="'. $cart_url .'" title="'. $viewing_cart .'">';
			}

			$menu_item .= '<i class="fa fa-shopping-cart"></i> ';

			$menu_item .= $cart_contents.' - '. $cart_total;
			$menu_item .= '</a></li>';
		// Раскомментируйте строку ниже для того, чтобы скрыть иконку корзины в меню, когда нет добавленных товаров в корзине.
		// }
		echo $menu_item;
	$social = ob_get_clean();
	return $menu . $social;

}




?>