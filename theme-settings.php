<?php

function mies_settings($saved_settings){
	// The default values for the theme variables
  $defaults = array(
    'mies_collumns_number' => 8,
    'mies_collumn_width' => 112,
    'mies_interspace_width' => 10,
    'mies_unit' => "px"
  );

  // Merge the saved variables and their default values
  $settings = array_merge($defaults, $saved_settings);

  
  $form['mies_collumns_number'] = array(
    '#type' => 'textfield',
    '#title' => t('Number of Collumns'),
    '#default_value' => $settings['mies_collumns_number'],
  );
	
  $form['mies_collumn_width'] = array(
    '#type' => 'textfield',
    '#title' => t('Width of each Collumn'),
    '#default_value' => $settings['mies_collumn_width'],
  );
  
  $form['mies_interspace_width'] = array(
    '#type' => 'textfield',
    '#title' => t('Width of Interspace'),
    '#default_value' => $settings['mies_interspace_width'],
  );
  
  $form['mies_unit'] = array(
    '#type' => 'textfield',
    '#title' => t('Unit'),
    '#default_value' => $settings['mies_unit'],
  );
  
  return $form;
  
}