<?php
/**
 * Powder Testing Properties interactive chart.
 *
 * Markup extracted from the Elementor HTML widget that used to sit in the
 * Methodologies section of the FT4 product page. Styles and behaviour live in
 * assets/css/ft-powder-chart.css and js/ft-powder-chart.js.
 *
 * @package freemantech
 */

?>
<div class="container" aria-label="Powder testing properties chart">
    <!-- Arrows SVG -->
    <svg class="arrow" width="100%" height="100%">
      <defs>
        <marker id="arrowhead" markerWidth="10" markerHeight="10" refX="9" refY="3" orient="auto">
          <polygon class="arrow-head" points="0 0, 10 3, 0 6"></polygon>
        </marker>
      </defs>

      <!-- Arrow to Bulk (top) -->
      <line class="arrow-line" x1="50%" y1="50%" x2="50%" y2="30%" marker-end="url(#arrowhead)"></line>
      <!-- Arrow to Shear (left) -->
      <line class="arrow-line" x1="50%" y1="50%" x2="30%" y2="50%" marker-end="url(#arrowhead)"></line>
      <!-- Arrow to Dynamic Flow (right) -->
      <line class="arrow-line" x1="50%" y1="50%" x2="70%" y2="50%" marker-end="url(#arrowhead)"></line>
      <!-- Arrow to Process (bottom) -->
      <line class="arrow-line" x1="50%" y1="50%" x2="50%" y2="70%" marker-end="url(#arrowhead)"></line>
    </svg>

    <!-- Center Circle -->
    <div class="circle center-circle" aria-hidden="true">
        <img src="http://freeman-wp.local/wp-content/uploads/2026/02/Ft4-illlustration.svg" width="80px">
    </div>

    <!-- Primary Circles -->
    <div class="circle primary-circle bulk" data-category="bulk">
      <!-- Bulk/Container Icon -->
     <img src="http://freeman-wp.local/wp-content/uploads/2026/02/bulk-icon.svg" width="60px">
      <div>Bulk</div>
    </div>

    <div class="circle primary-circle shear" data-category="shear">
      <!-- Shear/Tilted Square Icon -->
           <img src="http://freeman-wp.local/wp-content/uploads/2026/02/shear.svg" width="60px">

      <div>Shear</div>
    </div>

    <div class="circle primary-circle dynamic-flow" data-category="dynamic">
      <!-- Flow/Wave Icon -->
          <img src="http://freeman-wp.local/wp-content/uploads/2026/02/dynamic-flow.svg" width="60px">

      <div>Dynamic<br />Flow</div>
    </div>

    <div class="circle primary-circle process" data-category="process">
      <!-- Process/Gear Icon -->
           <img src="http://freeman-wp.local/wp-content/uploads/2026/02/process.svg" width="60px">

      <div>Process</div>
    </div>

    <!-- Secondary Circles - Bulk -->
    <div class="circle secondary-circle density" data-parent="bulk">Density</div>
    <div class="circle secondary-circle compressibility" data-parent="bulk">Compressibility</div>
    <div class="circle secondary-circle permeability" data-parent="bulk">Permeability</div>

    <!-- Secondary Circles - Shear -->
    <div class="circle secondary-circle shear-cell" data-parent="shear">Shear Cell</div>
    <div class="circle secondary-circle wall-friction" data-parent="shear">Wall Friction</div>

    <!-- Secondary Circles - Dynamic Flow -->
    <div class="circle secondary-circle basic-flowability" data-parent="dynamic">Basic<br />Flowability</div>
    <div class="circle secondary-circle aeration" data-parent="dynamic">Aeration</div>
    <div class="circle secondary-circle consolidation" data-parent="dynamic">Consolidation</div>
    <div class="circle secondary-circle flow-rate" data-parent="dynamic">Flow<br />Rate</div>
    <div class="circle secondary-circle specific-energy" data-parent="dynamic">Specific<br />Energy</div>

    <!-- Secondary Circles - Process -->
    <div class="circle secondary-circle segregation" data-parent="process">Segregation</div>
    <div class="circle secondary-circle attrition" data-parent="process">Attrition</div>
    <div class="circle secondary-circle caking" data-parent="process">Caking</div>
    <div class="circle secondary-circle electrostatics-left" data-parent="process" aria-label="Electrostatics (left)">Electrostatics</div>
    <div class="circle secondary-circle electrostatics-right" data-parent="process" aria-label="Electrostatics (right)">Electrostatics</div>
  </div>
