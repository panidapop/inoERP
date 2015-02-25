<form action=""  method="post" id="item"  name="item"><span class="heading">Item Master </span>
 <div id ="form_header">
  <div id="tabsHeader">
   <ul class="tabMain">
    <li><a href="#tabsHeader-1"><?php
      $f = new inoform();
      echo __('Basic Info')
      ?></a></li>
    <li><a href="#tabsHeader-2"><?php echo __('Inv Assignment') ?></a></li>
    <li><a href="#tabsHeader-3"><?php echo __('Revisions') ?></a></li>
    <li><a href="#tabsHeader-4"><?php echo __('Attachments') ?></a></li>
    <li><a href="#tabsHeader-5"><?php echo __('Note') ?></a></li>
    <li><a href="#tabsHeader-6"><?php echo __('Actions') ?></a></li>
   </ul>
   <div class="tabContainer"> 
    <div id="tabsHeader-1" class="tabContent">
     <ul class="column header_field">
      <li><?php
       if (!empty($item->org_id)) {
        $f->l_select_field_from_object('org_id', $org->findAll_inventory(), 'org_id', 'org', $item->org_id, 'org_id', '', 1, $readonly);
       } else {
        $f->l_select_field_from_object('org_id', $org->findAll_item_master(), 'org_id', 'org', $item->org_id, 'org_id', '', 1, $readonly);
       }
       ?> 
      </li>
      <li>
       <label><img src="<?php echo HOME_URL; ?>themes/images/serach.png" class="item_id select_popup clickable">
        <?php echo __('Item Id') ?></label><?php $f->text_field_dsr('item_id') ?>
       <a name="show" href="form.php?class_name=item&<?php echo "mode=$mode"; ?>" class="show document_id item_id"><i class="fa fa-refresh"></i></a> 
      </li>
      <li><label><?php echo __('Item Number') ?><img src="<?php echo HOME_URL; ?>themes/default/images/plus_10.png" class="disable_autocomplete item_number clickable">
       </label><?php echo $f->text_field('item_number', $$class->item_number, '15', 'item_number', 'select_item_number', 1, $readonly_mas); ?>
       <a name="show" href="form.php?class_name=item&<?php echo "mode=$mode"; ?>" class="show2 document_id findBy_item_number"><i class="fa fa-refresh"></i></a> 
      </li>
      <li><?php $f->l_text_field('item_description', $$class->item_description, '20', 'item_description', '', 1, $readonly_mas); ?></li>
      <li><?php $f->l_select_field_from_object('product_line', item::product_line(), 'option_line_code', 'option_line_value', $$class->product_line, 'product_line', '', '', $readonly_mas); ?></li>
     </ul>
    </div>
    <div id="tabsHeader-2" class="tabContent">
     <div class="large_shadow_box"> 
      <ul class="column five_column">
       <li><?php echo $f->l_text_field_dr('item_id_m'); ?> </li>
      </ul>
      <?php echo!(empty($assigned_inventory_statement)) ? $assigned_inventory_statement : ""; ?>
     </div>
    </div>
    <div id="tabsHeader-3" class="tabContent">
     <div><ul class='column header_field'><li><?php $f->l_checkBox_field('update_revision_cb', '') ?></li></ul>
      <div id="tabsDetail">
       <div>
        <div id="tabsDetail-1" class="tabContent">
         <table class="form_line_data_table">
          <thead> 
           <tr>
            <th><?php echo __('Action') ?></th>
            <th><?php echo __('Seq') ?>#</th>
            <th><?php echo __('Line Id') ?></th>
            <th><?php echo __('Revision') ?></th>
            <th><?php echo __('Description') ?></th>
            <th><?php echo __('Reason') ?></th>
            <th><?php echo __('ECO') ?></th>
            <th class='two_lines'><?php echo __('Eff. Start Date') ?></th>
            <th class='two_lines'><?php echo __('End Date') ?></th>
            <th class='two_lines'><?php echo __('Implementation Date') ?></th>
            <th class='two_lines'><?php echo __('Origination Date') ?></th>
           </tr>
          </thead>
          <tbody class="form_data_line_tbody">
           <?php
           $count = 0;
           $inv_item_revision_object = inv_item_revision::find_by_itemIdM_orgId($$class->item_id_m, $$class->org_id);
           if (empty($inv_item_revision_object)) {
            $inv_item_revision_object = array(new inv_item_revision());
           }
           foreach ($inv_item_revision_object as $inv_item_revision) {
            $reaonly_ir = !empty($inv_item_revision->inv_item_revision_id) ? true : false;
            ?>         
            <tr class="inv_item_revision<?php echo $count ?>">
             <td>
              <?php
              echo ino_inline_action($inv_item_revision->inv_item_revision_id, '');
              ?>
             </td>
             <td><?php $f->seq_field_d($count) ?></td>
             <td><?php $f->text_field_wid2sr('inv_item_revision_id'); ?></td>
             <td><?php echo $f->text_field_ap(array('name' => 'revision_name', 'value' => $$class_second->revision_name, 'readonly' => $reaonly_ir, 'class_name' => 'small')); ?></td>
             <td><?php $f->text_field_wid2('description'); ?></td>
             <td><?php $f->text_field_wid2('reason'); ?></td>
             <td><?php
              if ($reaonly_ir) {
               $f->text_field_wid2r('eco_number');
              } else {
               $f->text_field_wid2('eco_number');
              }
              ?></td>
             <td><?php echo ($reaonly_ir == true) ? $f->date_fieldAnyDay_r('effective_start_date', $$class_second->effective_start_date, 1) : $f->date_fieldAnyDay('effective_start_date', $$class_second->effective_start_date); ?></td>
             <td><?php echo ($reaonly_ir == true) ? $f->date_fieldAnyDay('effective_end_date', $$class_second->effective_end_date, 1) : $f->date_fieldAnyDay('effective_end_date', $$class_second->effective_end_date); ?></td>
             <td><?php echo ($reaonly_ir == true) ? $f->date_fieldAnyDay_r('implementation_date', $$class_second->implementation_date, 1) : $f->date_fieldAnyDay('implementation_date', $$class_second->implementation_date); ?></td>
             <td><?php echo ($reaonly_ir == true) ? $f->date_fieldAnyDay_r('origination_date', $$class_second->origination_date, 1) : $f->date_fieldAnyDay('origination_date', $$class_second->origination_date); ?></td>
            </tr>
            <?php
            $count = $count + 1;
           }
           ?>
          </tbody>
         </table>
        </div>
       </div>
      </div>
     </div>
    </div>
    <div id="tabsHeader-4" class="tabContent">
     <div> <?php echo ino_attachement($file) ?> </div>
    </div>
    <div id="tabsHeader-5" class="tabContent">
     <div id="comments">
      <div id="comment_list">
       <?php echo!(empty($comments)) ? $comments : ""; ?>
      </div>
      <div id ="display_comment_form">
       <?php
       $reference_table = 'item';
       $reference_id = $$class->item_id;
       ?>
      </div>
      <div id="new_comment">
      </div>
     </div>
     <div> 
     </div>
    </div>
    <div id="tabsHeader-6" class="tabContent">
     <div> 
      <ul class="column four_column">
       <li><label><img src="<?php echo HOME_URL; ?>themes/images/serach.png" class="select_item_template select_popup clickable">
         <?php echo __('Item/Template') ?>: </label><input type="text" class="text_field select_item_template item_template" id="item_template">
        <button class="button non_clickable apply_item_template " id="apply_item_template">Apply</button>
       </li>
      </ul>
     </div>
    </div>
   </div>

  </div>
 </div>
 <div id ="form_line" class="form_line"><span class="heading"> Item Details </span>
  <div id="tabsLine">
   <ul class="tabMain">
    <li><a href="#tabsLine-1">Main</a></li>
    <li><a href="#tabsLine-2">Inventory</a></li>
    <li><a href="#tabsLine-3">Sales</a></li>
    <li><a href="#tabsLine-4">Purchasing</a></li>
    <li><a href="#tabsLine-5">Manufacturing</a></li>
    <li><a href="#tabsLine-6">Planning</a></li>
    <li><a href="#tabsLine-7">Control</a></li>
    <li><a href="#tabsLine-8">Financial</a></li>
    <li><a href="#tabsLine-9">Secondary</a></li>
   </ul>
   <div class="tabContainer"> 
    <div id="tabsLine-1" class="tabContent">
     <div class="first_rowset"> 
      <ul class="column five_column"> 
       <li><?php $f->l_select_field_from_object('item_type', item::item_types(), 'option_line_code', 'option_line_value', $item->item_type, 'item_type', '', 1, $readonly); ?>       </li> 
       <li><?php echo $f->l_select_field_from_object('uom_id', uom::find_all(), 'uom_id', 'uom_name', $item->uom_id, 'uom_id', '', 1, $readonly); ?>       </li>
       <li><?php echo $f->l_number_field('product_line_percentage', $$class->product_line_percentage, '8'); ?></li>
       <li><?php echo $f->l_select_field_from_object('item_status', item::item_status(), 'option_line_id', 'option_line_code', $item->item_status, 'item_status', '', '', $readonly); ?>       </li>
      </ul>
     </div>

     <div class="second_rowset">
      <div class="panel panel-collapse panel-ino-classy medium_box">
       <div class="panel-heading"><div class="panel-title"><?php echo __('Long Descriptions') ?></div></div>
       <div class="panel-body">
        <ul class="column line_field">
         <li><?php echo form::text_area('long_description', $item->long_description, '5', '30', ''); ?></li>
        </ul>
       </div>
      </div>
      <div class="panel panel-collapse panel-ino-classy large_box">
       <div class="panel-heading"><div class="panel-title"><?php echo __('Lead Time Information') ?></div></div>
       <div class="panel-body">
        <ul class="column line_field">
         <li><?php $f->l_text_field_d('pre_processing_lt'); ?></li>
         <li><?php $f->l_text_field_d('processing_lt'); ?></li> 
         <li><?php $f->l_text_field_d('post_processing_lt'); ?></li> 
         <li><?php $f->l_text_field_d('cumulative_mfg_lt'); ?></li>
         <li><?php $f->l_text_field_d('cumulative_total_lt'); ?></li>
         <li><?php $f->l_text_field_d('lt_lot_size'); ?></li>
        </ul>
       </div>
      </div>
     </div>
     <!--end of tab1 div three_column-->
    </div> 
    <!--end of tab1-->
    <div id="tabsLine-2" class="tabContent">
     <div class="first_rowset"> 
      <ul class="column header_field"> 
       <li><?php $f->l_checkBox_field_d('inventory_item_cb'); ?></li>
       <li><?php $f->l_checkBox_field_d('stockable_cb'); ?></li>
       <li><?php $f->l_checkBox_field_d('transactable_cb'); ?></li>
       <li><?php $f->l_checkBox_field_d('reservable_cb'); ?></li>
       <li><?php $f->l_checkBox_field_d('cycle_count_enabled_cb'); ?></li>
       <li><?php $f->l_checkBox_field_d('equipment_cb'); ?></li>
       <li><?php $f->l_checkBox_field_d('electronic_format_cb'); ?></li>
       <li><?php $f->l_checkBox_field_d('onhand_with_rev_cb'); ?></li>
       <li><?php $f->l_checkBox_field_d('item_rev_number'); ?></li>
       <li><?php $f->l_text_field_d('locator_control'); ?></li>
       <li><?php $f->l_checkBox_field_d('kit_cb'); ?></li>
      </ul>
     </div>
     <div class="second_rowset">
      <div class="panel panel-collapse panel-ino-classy medium_box">
       <div class="panel-heading"><div class="panel-title"><?php echo __('Lot Information') ?></div></div>
       <div class="panel-body">
        <ul class="column line_field">
         <li><?php $f->l_select_field_from_array('lot_uniqueness', item::$ls_uniqueness_a, $$class->lot_uniqueness); ?>   </li>
         <li><?php $f->l_select_field_from_array('lot_generation', item::$ls_generation_a, $$class->lot_generation); ?></li> 
         <li><?php $f->l_text_field_d('lot_prefix'); ?></li> 
         <li><?php $f->l_text_field_d('lot_starting_number'); ?></li>
        </ul>
       </div>
      </div>
      <div class="panel panel-collapse panel-ino-classy medium_box">
       <div class="panel-heading"><div class="panel-title"><?php echo __('Serial Information') ?></div></div>
       <div class="panel-body">
        <ul class="column line_field">
         <li><?php $f->l_select_field_from_array('serial_uniqueness', item::$ls_uniqueness_a, $$class->serial_uniqueness); ?>         </li>
         <li><?php $f->l_select_field_from_array('serial_generation', item::$ls_generation_a, $$class->serial_generation); ?>         </li> 
         <li><?php $f->l_text_field_d('serial_prefix'); ?></li> 
         <li><?php $f->l_text_field_d('serial_starting_number'); ?></li>
        </ul>
       </div>
      </div>
      <div class="panel panel-collapse panel-ino-classy medium_box">
       <div class="panel-heading"><div class="panel-title"><?php echo __('Measurement Information') ?></div></div>
       <div class="panel-body">
        <ul class="column line_field">
         <li><?php $f->l_select_field_from_object('weight_uom_id', uom::find_all(), 'uom_id', 'uom_name', $item->weight_uom_id, 'weight_uom_id', '', '', $readonly); ?></li>
         <li><?php $f->l_text_field_d('weight'); ?></li> 
         <li><?php $f->l_select_field_from_object('volume_uom_id', uom::find_all(), 'uom_id', 'uom_name', $item->volume_uom_id, 'volume_uom_id', '', '', $readonly); ?></li>
         <li><?php $f->l_text_field_d('volume'); ?></li>
         <li><?php $f->l_select_field_from_object('dimension_uom_id', uom::find_all(), 'uom_id', 'uom_name', $item->dimension_uom_id, 'dimension_uom_id', '', '', $readonly); ?></li>
         <li><?php $f->l_text_field_d('length'); ?></li>
         <li><?php $f->l_text_field_d('width'); ?></li>
         <li><?php $f->l_text_field_d('height'); ?></li>
        </ul>
       </div>
      </div>

     </div> 
     <!--                end of tab2 div three_column-->
    </div>
    <!--end of tab2 (purchasing)!!!! start of sales tab-->
    <div id="tabsLine-3" class="tabContent">
     <div class="first_rowset"> 
      <ul class="column header_field">
       <li><?php $f->l_checkBox_field_d('customer_ordered_cb'); ?></li> 
       <li><?php $f->l_checkBox_field_d('internal_ordered_cb'); ?></li>
       <li><?php $f->l_checkBox_field_d('shippable_cb'); ?></li>
       <li><?php $f->l_checkBox_field_d('returnable_cb'); ?></li>
      </ul>
     </div>
     <div class="second_rowset">
      <div class="panel panel-collapse panel-ino-classy medium_box">
       <div class="panel-heading"><div class="panel-title"><?php echo __('Rule Information') ?></div></div>
       <div class="panel-body">
        <ul class="column line_field">
         <li><?php $f->l_text_field_d('atp'); ?></li>
         <li><?php $f->l_text_field_d('picking_rule'); ?></li>
        </ul>
       </div>
      </div>
     </div>
    </div> 
    <!--                end of tab3 div three_column-->
    <!--end of tab3 (sales)!!!!start of purchasing tab-->
    <div id="tabsLine-4" class="tabContent">
     <div class="first_rowset"> 
      <ul class="column five_column"> 
       <li><label>Purchased : </label> 
        <?php echo form::checkBox_field('purchased_cb', $$class->purchased_cb, '', $readonly); ?>
       </li>
       <li><label>ASL usage mandatory : </label> 
        <?php echo form::checkBox_field('use_asl_cb', $$class->use_asl_cb, '', $readonly); ?>
       </li>
       <li><label><img src="<?php echo HOME_URL; ?>themes/images/serach.png" class="select_popup select_sourcing_rule clickable">
         Sourcing Rule : </label><?php $f->text_field_d('sourcing_rule') ?></li>
       <li><label>Invoice Matching : </label> 
        <?php echo form::text_field_d('invoice_matching'); ?>
       </li>
       <li><label>Default Buyer : </label> 
        <?php echo form::text_field_d('default_buyer'); ?>
       </li>
       <li><label>List Price : </label> 
        <?php echo form::text_field_d('list_price'); ?>
       </li> 
       <li><label>UN Number : </label> 
        <?php echo form::text_field_d('un_number'); ?>
       </li> 
      </ul>
     </div>
     <div class="second_rowset">
      <div class="panel panel-collapse panel-ino-classy extra_large_box">
       <div class="panel-heading"><div class="panel-title">Receipt Information</div></div>
       <div class="panel-body">
        <ul class="column line_field">
         <li><label>Receipt Routing</label><?php echo form::text_field_d('receipt_routing'); ?></li> 
         <li><label>Receiving SubInventory</label><?php echo form::text_field_d('receipt_sub_inventory'); ?></li> 
         <li><label>Over Receipt %</label><?php echo form::text_field_d('over_receipt_percentage'); ?></li>
         <li><label>Over Receipt Action</label><?php echo form::text_field_d('over_receipt_action'); ?></li>
         <li><label>Allowed early receipt days</label><?php echo form::text_field_d('receipt_days_early'); ?></li> 
         <li><label>Allowed late receipt days</label><?php echo form::text_field_d('receipt_days_late'); ?></li> 
         <li><label>Receipt Day Action</label><?php echo form::text_field_d('receipt_day_action'); ?></li>
        </ul>
       </div>
      </div>
     </div> 
    </div>
    <!--end of tab4(purchasing)!!! start of MFG tab-->
    <div id="tabsLine-5" class="tabContent">
     <div class="first_rowset"> 
      <ul class="column five_column"> 
       <li><label>Make or Buy : </label>
        <?php echo form::select_field_from_object('make_buy', item::manufacturing_item_types(), 'option_line_code', 'option_line_code', $item->make_buy, 'make_buy', $readonly); ?>
       </li>
       <li><label>BOM Enabled : </label>
        <?php echo form::checkBox_field('bom_enabled_cb', $$class->bom_enabled_cb, '', $readonly); ?>
       </li>
       <li><label>BOM Type: </label> 
        <?php echo $f->select_field_from_object('bom_type', item::bom_types(), 'option_line_code', 'option_line_value', $$class->bom_type, 'bom_type'); ?>       </li>
       <li><label>Build in WIP : </label>
        <?php echo form::checkBox_field('build_in_wip_cb', $$class->build_in_wip_cb, '', $readonly); ?>
       </li>
       <li><label>WIP Supply Type: </label> 
        <?php echo form::select_field_from_object('wip_supply_type', bom_header::wip_supply_type(), 'option_line_code', 'option_line_value', $item->wip_supply_type, '', $readonly, '', '', ''); ?>
       </li>
       <li><label>Supply Subinventory: </label> 
        <?php echo form::select_field_from_object('wip_supply_subinventory', subinventory::find_all_of_org_id($item->org_id), 'subinventory_id', 'subinventory', $item->wip_supply_subinventory, '', $readonly, 'subinventory_id', '', ''); ?>
       </li>
       <li><label>Supply Locator: </label> 
        <?php echo form::select_field_from_object('wip_supply_locator', locator::find_all_of_subinventory($item->wip_supply_subinventory), 'locator_id', 'locator', $item->wip_supply_locator, '', $readonly, 'locator_id', '', ''); ?>
       </li>

      </ul>
     </div>
     <div class="second_rowset">
      <div class="panel panel-collapse panel-ino-classy large_box">
       <div class="panel-heading"><div class="panel-title">Cost Information</div></div>
       <div class="panel-body">
        <ul class="column line_field">
         <li><label>Costing Enabled</label><?php echo form::checkBox_field('costing_enabled_cb', $$class->costing_enabled_cb, '', $readonly); ?>    </li>
         <li><label>Inventory Asset</label><?php echo form::checkBox_field('inventory_asset_cb', $$class->inventory_asset_cb, '', $readonly); ?>       </li>
         <li><label>COGS Ac</label><?php echo $f->ac_field_d('cogs_ac_id'); ?> </li>
         <li><label>Deferred COGS Ac</label><?php echo $f->ac_field_d('deffered_cogs_ac_id'); ?> </li>
        </ul>
       </div>
      </div>
     </div> 
    </div>
    <!--end of tab5 (Manufacturing)!! start of planning -->
    <div id="tabsLine-6" class="tabContent">
     <div class="first_rowset"> 
      <ul class="column five_column"> 
       <li><label>Allow Negative Balance: </label>
        <?php echo form::checkBox_field('allow_negative_balance_cb', $$class->allow_negative_balance_cb, '', $readonly); ?>
       </li> 
       <li><label>Planner: </label>
        <?php echo form::text_field_d('planner'); ?>
       </li>
       <li><label>Planning Method: </label>
        <?php echo $f->select_field_from_object('planning_method', item::planning_method(), 'option_line_code', 'option_line_value', $$class->planning_method); ?>
       </li>
       <li><label>Forecast Method: </label>
        <?php echo form::text_field_d('forecast_method'); ?>
       </li>
       <li><label>Forecast Control: </label> 
        <?php echo form::text_field_d('forecast_control'); ?>
       </li>
      </ul>
     </div>
     <div class="second_rowset">
      <div class="panel panel-collapse panel-ino-classy medium_box">
       <div class="panel-heading"><div class="panel-title">Order Modifiers</div></div>
       <div class="panel-body">
        <ul class="column line_field">
         <li><label>Fix Order Quantity</label><?php echo form::number_field_d('fix_order_quantity'); ?></li>
         <li><label>Fix Days Supply</label><?php echo form::number_field_d('fix_days_supply'); ?> </li>
         <li><label>Fix Lot Multiplier</label><?php echo form::number_field_d('fix_lot_multiplier'); ?></li>
         <li><label>Minimum Order Quantity</label><?php echo form::number_field_d('minimum_order_quantity'); ?></li>
         <li><label>Maximum Order Quantity</label> <?php echo form::number_field_d('maximum_order_quantity'); ?></li>
        </ul>
       </div>
      </div>

      <div class="panel panel-collapse panel-ino-classy medium_box">
       <div class="panel-heading"><div class="panel-title">Time Fences</div></div>
       <div class="panel-body">
        <ul class="column line_field">
         <li><label>Demand</label><?php echo form::text_field_d('demand_timefence'); ?></li>
         <li><label>Planning</label><?php echo form::text_field_d('planning_timefence'); ?></li>
         <li><label>Release</label><?php echo form::text_field_d('release_timefence'); ?></li>
         <li><label>Rounding : </label>
          <?php echo $f->select_field_from_object('rounding_option', item::rounding_option(), 'option_line_code', 'option_line_value', $$class->rounding_option, 'rounding_option', '', '', $readonly); ?>
         </li>
        </ul>
       </div>
      </div>

      <div class="panel panel-collapse panel-ino-classy medium_box">
       <div class="panel-heading"><div class="panel-title">Min Max Planning</div></div>
       <div class="panel-body">
        <ul class="column line_field">
         <li><label>Min Quantity</label><?php echo $f->number_field('minmax_min_quantity', $$class->minmax_min_quantity) ?></li>
         <li><label>Max Quantity</label><?php echo $f->number_field('minmax_max_quantity', $$class->minmax_max_quantity) ?></li>
         <li><label>Number of Bins</label><?php echo $f->number_field('minmax_multibin_number', $$class->minmax_multibin_number) ?></li>
         <li><label>Bin Size</label><?php echo $f->number_field('minmax_multibin_size', $$class->minmax_multibin_size) ?></li>
        </ul>
       </div>

      </div>

     </div> 
    </div>
    <div id="tabsLine-7" class="tabContent">
     <div class="first_rowset"> 
      <ul class="column five_column"> 
       <li><label>Maintenance Asset Type: </label>
        <?php
        $f = new inoform();
        echo $f->select_field_from_array('am_asset_type', item::$am_asset_type_a, $$class->am_asset_type, 'am_asset_type');
        ?>
       </li> 
      </ul>
     </div>
     <div class="panel panel-collapse panel-ino-classy medium_box">
      <div class="panel-heading"><div class="panel-title">Safety Stock</div></div>
      <div class="panel-body">
       <ul class="column line_field">
        <li><label>Quantity</label><?php echo form::text_field_d('saftey_stock_quantity'); ?></li>
        <li><label>Days</label><?php echo form::text_field_d('saftey_stock_days'); ?></li>
        <li><label>Percentage</label><?php echo form::text_field_d('saftey_stock_percentage'); ?></li>
       </ul>
      </div>
     </div>
     <div class="panel panel-collapse panel-ino-classy medium_box">
      <div class="panel-heading"><div class="panel-title">Asset Maintenance</div></div>
      <div class="panel-body">
       <ul class="column line_field">
        <li><label>Cause</label><?php echo $f->text_field_d('am_activity_cause') ?></li>
        <li><label>Activity Type</label><?php echo $f->text_field_d('am_activity_type') ?></li>
        <li><label>Source</label><?php echo $f->text_field_d('am_activity_source') ?></li>
       </ul>
      </div>

     </div>
    </div> 
    <!--end of tab6 (planning)...start of lead times-->
    <div id="tabsLine-8" class="tabContent">
     <div class="first_rowset"> 
      <ul class="column five_column"> 
       <li><label>Invoicable: </label>
        <?php echo form::text_field_d('demand_timefence'); ?>
       </li>
       <li><label>Invoice Matching: </label>
        <?php echo form::text_field_d('demand_timefence'); ?>
       </li>
       <li><label>Output Tax Class: </label>
        <?php echo $f->select_field_from_object('op_tax_class', item::product_tax_class(), 'option_line_code', 'option_line_value', $$class->op_tax_class, '', 'output_tax') ?>
       </li>
       <li><label>Input Tax Class: </label>
        <?php echo $f->select_field_from_object('ip_tax_class', item::product_tax_class(), 'option_line_code', 'option_line_value', $$class->ip_tax_class, '', 'input_tax') ?>
       </li>
       <li><label>AP Payment Term: </label>
        <?php echo form::text_field_d('demand_timefence'); ?>
       </li>
       <li><label>AR Payment Term: </label>
        <?php echo form::text_field_d('demand_timefence'); ?>
       </li>
      </ul>
     </div> 
     <div class="second_rowset">
      <div class="panel panel-collapse panel-ino-classy extra_large_box">
       <div class="panel-heading"><div class="panel-title">Account</div></div>
       <div class="panel-body">
        <ul class="column line_field">
         <li><label>Material</label><?php $f->ac_field_d('material_ac_id'); ?></li>
         <li><label>Material</label><?php $f->ac_field_d('material_ac_id'); ?></li>
         <li><label>OverHead</label> <?php $f->ac_field_d('material_ac_id'); ?></li>
         <li><label>Resource</label> <?php $f->ac_field_d('resource_ac_id'); ?></li>
         <li><label>Expense</label><?php $f->ac_field_d('expense_ac_id'); ?></li>
         <li><label>OSP Ac</label> <?php $f->ac_field_d('material_ac_id'); ?> </li>
         <li><label>Sales Ac</label><?php $f->ac_field_d('sales_ac_id'); ?> </li>
        </ul>
       </div>
      </div>
     </div> 
    </div>
    <!--                  end of tab7 (Fiance)--> 
    <div id="tabsLine-9" class="tabContent">
     <?php echo!empty($secondary_field_stmt) ? $secondary_field_stmt : null; ?>
    </div>
   </div>


  </div>
 </div> 
</form>

<div id="js_data">
 <ul id="js_saving_data">
  <li class="headerClassName" data-headerClassName="item" ></li>
  <li class="savingOnlyHeader" data-savingOnlyHeader="true" ></li>
  <li class="primary_column_id" data-primary_column_id="item_id" ></li>
  <li class="form_header_id" data-form_header_id="item" ></li>
 </ul>
 <ul id="js_contextMenu_data">
  <li class="docHedaderId" data-docHedaderId="item_id" ></li>
  <li class="btn1DivId" data-btn1DivId="item" ></li>
 </ul>
</div>