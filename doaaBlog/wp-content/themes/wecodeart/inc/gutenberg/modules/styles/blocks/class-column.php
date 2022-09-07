<?php
/**
 * WeCodeArt Framework
 *
 * WARNING: This file is part of the core WeCodeArt Framework. DO NOT edit this file under any circumstances.
 * Please do all modifications in the form of a child theme.
 *
 * @package		WeCodeArt Framework
 * @subpackage  Gutenberg CSS Frontend
 * @copyright   Copyright (c) 2022, WeCodeArt Framework
 * @since		5.0.0
 * @version		5.5.5
 */

namespace WeCodeArt\Gutenberg\Modules\Styles\Blocks;

defined( 'ABSPATH' ) || exit();

use WeCodeArt\Singleton;
use WeCodeArt\Gutenberg\Modules\Styles\Blocks as Base;
use function WeCodeArt\Functions\get_prop;

/**
 * Block CSS Processor
 */
class Column extends Base {
	/**
	 * Parses an output and creates the styles array for it.
	 *
	 * @return 	null
	 */
	protected function process_extra() {		
		$output 			= [];
		$output['element'] 	= $this->element;
		
		// Custom Width
		if ( $value = get_prop( $this->attrs, 'width' ) ) {
			$this->output[] = wp_parse_args( [
				'property' 	=> 'flex',
				'value'	  	=> sprintf( '0 0 %s', $value ),
			], $output );
		}

		// Block Gap
		if ( $gap = get_prop( $this->attrs, [ 'style', 'spacing', 'blockGap' ] ) ) {
			if ( is_array( $gap ) ) {
				$gap	= get_prop( $gap, [ 'top' ] );
			}

			$gap = $gap ? $gap : 'var( --wp--style--block-gap )';

			$this->output[] = wp_parse_args( [
				'property'	=> 'gap',
				'value'		=> null,
			], $output );

			$this->output[] = wp_parse_args( [
				'element'	=> implode( '>', [ $this->element, '*' ] ),
				'property'	=> 'margin-block-start',
				'value'		=> 0,
			], $output );
			$this->output[] = wp_parse_args( [
				'element'	=> implode( '>', [ $this->element, '*' ] ),
				'property'	=> 'margin-block-end',
				'value'		=> 0,
			], $output );
			$this->output[] = wp_parse_args( [
				'element'	=> implode( '>', [ $this->element, '*+*' ] ),
				'property'	=> 'margin-block-start',
				'value'		=> $gap,
			], $output );
			$this->output[] = wp_parse_args( [
				'element'	=> implode( '>', [ $this->element, '*+*' ] ),
				'property'	=> 'margin-block-end',
				'value'		=> 0,
			], $output );
		}
	}
}