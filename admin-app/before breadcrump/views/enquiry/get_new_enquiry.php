
<?php if(isset($new_enquiry[0]['enquiry_id'])){?>
<?php

  if($new_enquiry[0]['email_address']=='') {
			          $email ='';
			       } else {
				  $email = stripslashes($new_enquiry[0]['email_address']);
			       }	 
				$viewLink = BACKEND_URL."enquiry/view_enquiry/".$new_enquiry[0]['enquiry_id']."/0/";
				$leadLink = BACKEND_URL."enquiry/lead_enquiry/".$new_enquiry[0]['enquiry_id']."/0/";
				$deleteLink = BACKEND_URL."enquiry/delete_enquiry/".$new_enquiry[0]['enquiry_id']."/0/";
	
				if(stripslashes(trim($new_enquiry[0]['notes'])) != '') {
				  $notes = sub_word($new_enquiry[0]['notes'], 50);
				} else {
				  $notes = 'N.A.';
				}
				$pos = stripos($notes, "wdc");
				if ($pos === false) {
				?>				
                        <tr <?php if($new_enquiry[0]['enquiry_read']=='Unread'){?> style=" background-color: #fce9e9;"<?php }else{?>style=" background-color: #f4fcec;" <?php }?>>
                            <td><input type="checkbox" name="page[]" class="checkItem" value="<?php echo $new_enquiry[0]['enquiry_id'];?>" /></td>
                            <td><?php echo stripslashes($new_enquiry[0]['contact_name']);?></td>
                            <td><?php echo $new_enquiry[0]['email_address'];?></td>
			    <td><?php echo $notes;?></td>
			    <!--<td><?php //echo ($new_enquiry[0]['phone'] != '') ? $new_enquiry[0]['phone'] : 'N.A.';?></td>
			    <td><?php //echo $new_enquiry[0]['guest'];?></td>-->
			    <td>
			      <?php if(trim($new_enquiry[0]['property_id']) != '' && isset($new_enquiry[0]['prop_name'])) { ?>
			      <a href="<?php if($new_enquiry[0]['sales_rentals']=="Rental") { echo FRONTEND_URL.'property-rentals/'.$new_enquiry[0]['prop_slug'].'/'; } else if ($new_enquiry[0]['sales_rentals']=="Sales") { echo FRONTEND_URL.'property-sales/'.$new_enquiry[0]['prop_slug'].'/'; } ?>" target="_blank">
				<?php echo stripslashes($new_enquiry[0]['prop_name']);?> 
			      </a>
			      <?php } else { echo 'N.A.'; }?>
			    </td>
			    <td><?php echo $new_enquiry[0]['sales_rentals'];?></td>
			     <td><?php if($new_enquiry[0]['is_mobile']=="Yes"){ echo "Mobile";} else if($new_enquiry[0]['is_mobile']=="No"){ echo "Desktop";} ?></td>
			    <td><?php echo @date("d/m/Y H:i:s", strtotime($new_enquiry[0]['added_on']));?></td>
                            <td>
			      <a class="tablectrl_small bDefault tipS" href="<?php echo $viewLink;?>" title="Details">
                                    <button type="button" class="btn btn-info btn-xs"><i class="fa fa-file-text-o"></i>&nbsp;
                                                            Details 
                                    </button>
                              </a>
                              &nbsp;<br>
			      
			  <?php if($this->session->userdata('role') == 'agent') { if($new_enquiry[0]['assigned_user'] == 1) {?>		      
			      <!--<a class="tablectrl_small bDefault tipS" href="<?php echo $leadLink;?>" title="Lead">
                                    <button type="button" class="btn btn-xs btn-success"><i class="fa fa-plus"></i>&nbsp;
                                                            Lead 
                                    </button>
                              </a>-->
                             <?php } } else if($this->session->userdata('role') == 'admin') { ?>			     
			      <!--<a class="tablectrl_small bDefault tipS" href="<?php echo $leadLink;?>" title="Lead">
                                    <button type="button" class="btn btn-xs btn-success"><i class="fa fa-plus"></i>&nbsp;
                                                            Lead 
                                    </button>
                              </a>
                              &nbsp;<br><br>-->
                              <a class="tablectrl_small bDefault tipS" href="<?php echo $deleteLink;?>" title="Delete" onclick="return confirm('Are you sure?');">
                                      <button type="button" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i>&nbsp;
                                                            Delete
                                      </button>
                              </a>
			     <?php } else { ?>&nbsp;<?php } ?>
                            
                            </td> 
                        </tr>

<?php }}?>
<input type="hidden" name="latest_enquiry" id="latest_enquiry" value="<?php echo $latest_id; ?>">