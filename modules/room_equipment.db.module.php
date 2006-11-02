<?php
 // $Id$
 //
 // Authors:
 // 	Jeff Buchbinder <jeff@freemedsoftware.org>
 //
 // FreeMED Electronic Medical Record and Practice Management System
 // Copyright (C) 1999-2006 FreeMED Software Foundation
 //
 // This program is free software; you can redistribute it and/or modify
 // it under the terms of the GNU General Public License as published by
 // the Free Software Foundation; either version 2 of the License, or
 // (at your option) any later version.
 //
 // This program is distributed in the hope that it will be useful,
 // but WITHOUT ANY WARRANTY; without even the implied warranty of
 // MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 // GNU General Public License for more details.
 //
 // You should have received a copy of the GNU General Public License
 // along with this program; if not, write to the Free Software
 // Foundation, Inc., 675 Mass Ave, Cambridge, MA 02139, USA.

LoadObjectDependency('org.freemedsoftware.core.SupportModule');

class RoomEquipment extends SupportModule {

	var $MODULE_NAME    = "Room Equipment";
	var $MODULE_VERSION = "0.1";
	var $MODULE_FILE    = __FILE__;
	var $MODULE_UID     = "3c993257-d9d0-46db-a731-bb1f6df7b59c";

	var $PACKAGE_MINIMUM_VERSION = '0.7.0';

	var $table_name     = "roomequip";
	var $record_name    = "Room Equipment";
	var $order_field    = "reqname,reqdescrip";

	var $widget_hash    = "##reqname## (##reqdescrip##)";

	public function __construct () {
		// __("Room Equipment")

		$this->list_view = array (
			__("Name")		=>	"reqname",
			__("Description")	=>	"reqdescrip"
		);

		$this->variables = array (
			"reqname",
			"reqdescrip"
		);

		parent::__construct( );
	} // end constructor

} // end class RoomEquipment

register_module ("RoomEquipment");

?>
