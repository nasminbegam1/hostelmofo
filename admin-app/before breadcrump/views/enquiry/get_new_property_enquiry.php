<?php
if(isset($new_enquiry[0]['sf_id'])){?>
<?php

  if($new_enquiry[0]['sf_sender_email']=='') {
			          $email ='';
			       } else {
				  $email = stripslashes($new_enquiry[0]['sf_sender_email']);
			       }	 
				
				$deleteLink = BACKEND_URL."property_share/delete_enquiry/".$new_enquiry[0]['sf_id']."/0/";
				$viewLink = BACKEND_URL."property_share/view_enquiry/".$new_enquiry[0]['sf_id']."/0/";
				if(stripslashes(trim($new_enquiry[0]['sf_message'])) != '') {
				  $notes = sub_word($new_enquiry[0]['sf_message'], 50);
				} else {
				  $notes = 'N.A.';
				}
				$pos = stripos($notes, "wdc");
				if ($pos === false) {
				?>				
                        <tr>
                            <td><input type="checkbox" name="page[]" class="checkItem" value="<?php echo $new_enquiry[0]['sf_id'];?>" /></td>
                            <td><?php echo stripslashes($new_enquiry[0]['sf_sender_name']);?></td>
                            <td><?php echo $email;?></td>
			    <td><?php echo $notes;?></td>
			    <td>
			      <?php if(trim($new_enquiry[0]['sf_property_name']) != '') { ?>
			      <a href="<?php if($new_enquiry[0]['sales_rentals'] == "Sales") { echo FRONTEND_URL.'property-sales/'.$new_enquiry[0]['prop_slug'].'/'; } else if($new_enquiry[0]['sales_rentals'] == "Rental") { echo FRONTEND_URL.'property-rentals/'.$new_enquiry[0]['prop_slug'].'/'; } ?>" target="_blank">
			      
				<?php echo stripslashes($new_enquiry[0]['sf_property_name']);?>
			      </a>
			      <?php } else { echo 'N.A.'; }?>
			    </td>
			     <td><?php
			    $reciv_mail=explode(",",$new_enquiry[0]['sf_receiver_email']);
			    echo implode(", ",$reciv_mail);
			    ?></td>
			     <td><?php echo stripslashes($new_enquiry[0]['sales_rentals']);?></td>
			    <td><?php echo @date("d/m/Y", strtotime($new_enquiry[0]['sf_date']));?></td>
			     <td>
                                    <a class="tablectrl_small bDefault tipS" href="<?php echo $viewLink;?>" title="Details">
                                    <button type="button" class="btn btn-info btn-xs"><i class="fa fa-file-text-o"></i>&nbsp;
                                                            Details 
                                    </button>
                                    </a>
                                    &nbsp;<br>
                                  
                                    <a class="tablectrl_small bDefault tipS" href="<?php echo $deleteLink;?>" title="Delete" onclick="return confirm('Are you sure?');">
                                      <button type="button" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i>&nbsp;
                                                            Delete
                                      </button>
                                    </a>
                               
                            
                            </td> 
                            
                        </tr>

<?php }}?>
<input type="hidden" name="latest_enquiry" id="latest_enquiry" value="<?php echo $latest_id; ?>">