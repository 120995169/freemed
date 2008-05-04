/*
 * $Id$
 *
 * Authors:
 *      Jeff Buchbinder <jeff@freemedsoftware.org>
 *
 * FreeMED Electronic Medical Record and Practice Management System
 * Copyright (C) 1999-2008 FreeMED Software Foundation
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 675 Mass Ave, Cambridge, MA 02139, USA.
 */

package org.freemedsoftware.gwt.client.widget;

import java.util.ArrayList;

import com.google.gwt.user.client.ui.ChangeListener;
import com.google.gwt.user.client.ui.ClickListener;
import com.google.gwt.user.client.ui.Composite;
import com.google.gwt.user.client.ui.FlowPanel;
import com.google.gwt.user.client.ui.HTML;
import com.google.gwt.user.client.ui.HorizontalPanel;
import com.google.gwt.user.client.ui.Label;
import com.google.gwt.user.client.ui.TextBox;
import com.google.gwt.user.client.ui.Widget;

public class PatientTagsWidget extends Composite {

	protected Integer patientId = new Integer(0);
	
	/**
	 * @gwt.typeArgs <java.lang.String>
	 */
	protected ArrayList tags = null;
	
	protected final FlowPanel flowPanel;
	protected final TextBox wEntry;
	
	public PatientTagsWidget( ) {
		flowPanel = new FlowPanel();
		initWidget(flowPanel);

		wEntry = new TextBox();
		flowPanel.add(wEntry);
		wEntry.addChangeListener(new ChangeListener() {
			public void onChange( Widget w ) {
				TextBox t = (TextBox) w;
				if (t.getText().length() > 2) {
					addTag(t.getText());
				}
			}
		});
	}
	
	/**
	 * Update database to set new tag.
	 * 
	 * @param tag
	 */
	public void addTag( String tag ) {
		wEntry.setText("");		
	}
	
	/**
	 * Actual addition of tag to display.
	 * 
	 * @param tag
	 */
	protected void addTagToDisplay( String tag ) {
		HorizontalPanel p = new HorizontalPanel();
		p.setTitle(tag);
		HTML r = new HTML("<sup>X</sup>");
		p.add(new Label(tag));
		p.add(r);
		p.setStyleName("freemed-PatientTag");
		r.addClickListener(new ClickListener() {
			public void onClick( Widget w ) {
				HorizontalPanel container = (HorizontalPanel) w.getParent();
				removeTag(container.getTitle());
				container.removeFromParent();
			}
		});
		flowPanel.add(p);
	}
	/**
	 * Update database to remove tag.
	 * 
	 * @param tag
	 */
	public void removeTag( String tag ) {
	}
	
	
	/**
	 * Set internal patient id representation.
	 * 
	 * @param patient
	 */
	public void setPatient( Integer patient ) {
		patientId = patient;
	}
	
}

