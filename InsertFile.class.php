<?php

/**
 * InsertFile extension for BlueSpice
 *
 * Dialogbox to upload files and enter a file link.
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, version 3.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 *
 * This file is part of BlueSpice MediaWiki
 * For further information visit http://www.bluespice.com
 *
 * @author     Markus Glaser <glaser@hallowelt.com>
 * @author     Sebastian Ulbricht
 * @author     Tobias Weichart <weichart@hallowelt.com>
 * @package    BlueSpiceInsertFile
 * @copyright  Copyright (C) 2016 Hallo Welt! GmbH, All rights reserved.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU Public License v3
 * @filesource
 */

/**
 * Class for file upload and management assistent
 * @package BlueSpiceInsertFile
 */
class InsertFile extends BsExtensionMW {
	/**
	 * Initialise the InsertFile extension
	 */
	protected function initExt() {
		$this->setHook( 'VisualEditorConfig' );
	}

	/**
	 * Hook Handler for VisualEditorConfig Hook
	 * @param Array $aConfigStandard reference
	 * @param Array $aConfigOverwrite reference
	 * @param Array &$aLoaderUsingDeps reference
	 * @return boolean always true to keep hook alife
	 */
	public function onVisualEditorConfig( &$aConfigStandard, &$aConfigOverwrite, &$aLoaderUsingDeps ) {
		$aLoaderUsingDeps[] = 'ext.bluespice.insertFile';

		// TODO SW: use string as parameter !!
		$iIndexStandard = array_search( 'unlink',$aConfigStandard["toolbar1"] );
		array_splice( $aConfigStandard["toolbar1"], $iIndexStandard + 1, 0, "bsimage" );
		array_splice( $aConfigStandard["toolbar1"], $iIndexStandard + 2, 0, "bsfile" );

		$iIndexOverwrite = array_search( 'unlink',$aConfigOverwrite["toolbar2"] );
		array_splice( $aConfigOverwrite["toolbar2"], $iIndexOverwrite + 1, 0, "bsimage" );

		// Add context menu entry
		$aConfigStandard["contextmenu"] = str_replace('bsContextMenuMarker', 'bsContextMenuMarker bsContextImage', $aConfigStandard["contextmenu"] );
		return true;
	}

}
