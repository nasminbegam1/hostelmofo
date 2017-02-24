<!--<html>
    <body style="font-size:12px;font-family:arial;">
        <div style="width:800px;">
            <p>Hello, <?php echo $toname; ?></p>
            <div style="margin-top:20px;background-color: #F3F3F3; ">
                <?php echo $content; ?>
            </div>
            <div style="margin-top:20px;">
                <p><strong>Thanks,</strong></p>
                <p><?php echo $fromname; ?></p>
            </div>
        </div>
    </body>
</html>-->



<table width="800" bgcolor="#f1f1f1" align="center" style="border:4px solid #09b6e8;">
  <tbody>
<tr>
      <td valign="middle" height="30" align="left" style="font-size:20px;font-weight:bold;color:#222222;padding:10px">Here's a copy of your enquiry</td>
    </tr>
    <tr>
      <td valign="middle" height="40" align="left" style="font-size:18px;font-weight:bold;color:#09b6e8;padding-left:10px">Hi <?php echo $toname; ?>,</td>
    </tr>
    <tr>
      <td height="10">&nbsp;</td>
    </tr>
    <tr>
      <td align="center"><table width="770" cellspacing="0" cellpadding="0" border="0" bgcolor="#e3e3e3" align="center" style="border:4px solid #09b6e8">
          <tbody>
            <tr>
              <td style="padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;color:#3a4247;font-size:15px;font-weight:400;font-style:normal">My name is <?php echo $fromname; ?> and I will be looking after you with this enquiry. If you need to contact me urgently, our  number is <span style="color:#008db6"> <?php echo $phone; ?> </span> or you can email me directly at <a href="#14be42df105e2a48_14bc4745ded27a1c_" style="text-decoration:none;color:#008db6"> <?php echo $from_email ; ?></a>. Please feel free to ask me anything and I will do my best to help you with your request.</td>
            </tr>
          </tbody>
        </table></td>
    </tr>
    <tr>
      <td height="10">&nbsp;</td>
    </tr>
    <tr>
      <td style="padding-top:10px;padding-right:20px;padding-bottom:10px;padding-left:20px;font-size:15px;color:#565a5b">Thanks for using <?php echo SITENAME; ?> to find a property in Australia for your upcoming trip. I am currently looking into your enquiry, validating your requirements and the availability of the properties you have viewed and requested. You will shortly receive a follow up by a customer service representative.</td>
    </tr>
    <tr>
      <td height="10">&nbsp;</td>
    </tr>
    <tr>
      <td valign="middle" align="left"><table width="770" cellspacing="0" cellpadding="0" border="0" align="center">
          <tbody>
            <tr>
              
              <td><p style="font-size:15px;color:#047495;margin-top:0;margin-right:0;margin-bottom:0;margin-left:0"><b><?php echo SITENAME; ?> Guarantee</b></p>
                <p style="font-size:14px;color:#222222;margin-top:0;margin-right:0;margin-bottom:0;margin-left:0">All properties that are listed on the <?php echo SITENAME; ?> website have been verified and validated. Book safely with <?php echo SITENAME; ?>, we are based here in Australia and ensure that all bookings are 100% guaranteed.</p></td>
            </tr>
          </tbody>
        </table></td>
    </tr>
    <tr>
      <td height="20">&nbsp;</td>
    </tr>
    <tr>
      <td align="center"><table width="770" cellspacing="0" cellpadding="0" border="0" bgcolor="09b6e8" align="center">
          <tbody>
            <tr>
              <td style="padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;font-size:16px;color:#ffffff">Your  Enquiry Details</td>
            </tr>
            <tr>
              <td style="padding-top:0;padding-right:10px;padding-bottom:10px;padding-left:10px"><table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="ffffff" align="center">
                  <tbody>
                    <tr>
                      <td style="padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px"><table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="ffffff" align="center">
                          <tbody>
                            <tr>
                              <td width="260" valign="top" align="left"><a href="<?php  echo $property_link ;?>" target="_blank"><img src="<?php echo $property_img; ?>" width="250" height="132" class="CToWUd" /></a></td>
                              <td valign="top" align="left"><p style="margin-bottom:5px;margin-top:0;margin-left:0;margin-right:0;font-weight:bold;font-size:14px;color:#218bcf"><a href="<?php  echo $property_link ;?>" target="_blank"><?php echo $property_name;  ?></a></p>
                                
                                
                                <p style="margin-bottom:5px;margin-top:0;margin-left:0;margin-right:0;font-size:12px;color:#787878"><?php echo $property_city; ?> in <a href="<?php  echo FRONTEND_URL.'property-rent/'.$property_slug.'/';?>" style="color:#00b0fe" title="" target="_blank"><?php echo $property_province; ?></a></p>
                                <p style="margin-bottom:5px;margin-top:0;margin-left:0;margin-right:0;font-size:13px;color:#787878">Months: <?php echo $checkin_date ?> - <?php echo $checkout_date ?></p></td>
                            </tr>
                          </tbody>
                        </table></td>
                    </tr>
                  </tbody>
                </table></td>
            </tr>
            <tr>
              <td style="padding-top:0;padding-right:10px;padding-bottom:10px;padding-left:10px"><table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="ffffff" align="center">
                  <tbody>
                    <tr>
                      <td style="padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px"><p style="margin-bottom:0;margin-top:0;margin-left:0;margin-right:0;font-weight:bold;font-size:16px;color:#047495"><b>Your message</b></p>
                        <p style="margin-bottom:5px;margin-top:0;margin-left:0;margin-right:0;font-size:14px;color:#555555"><?php echo $content ?></p></td>
                    </tr>
                  </tbody>
                </table></td>
            </tr>
          </tbody>
        </table></td>
    </tr>
    <tr>
      <td height="10">&nbsp;</td>
    </tr>
    <tr>
      <td style="padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:20px"><p style="margin-bottom:0;margin-top:0;margin-left:0;margin-right:0;font-weight:bold;font-size:20px;color:#222222">What Happens Next?</p></td>
    </tr>
    <tr>
      <td style="padding-top:0;padding-right:20px;padding-bottom:10px;padding-left:20px"><table width="100%" cellspacing="0" cellpadding="0" border="0">
          <tbody>
            <tr>
              <td width="20" valign="top" align="left" style="font-size:14px;color:#047495">1.</td>
              <td valign="top" align="left" style="font-size:14px;color:#222222;padding-bottom:10px">A <?php echo SITENAME; ?> customer service agent will be in contact with you regarding your above request</td>
            </tr>
            <tr>
              <td width="20" valign="top" align="left" style="font-size:14px;color:#047495">2.</td>
              <td valign="top" align="left" style="font-size:14px;color:#222222;padding-bottom:10px">Your customer service agent will confirm availability and exclusive rates with the property owner</td>
            </tr>
            <tr>
              <td width="20" valign="top" align="left" style="font-size:14px;color:#047495;padding-bottom:10px">3.</td>
              <td valign="top" align="left" style="font-size:14px;color:#222222;padding-bottom:10px">If you want to proceed with the booking, your customer service agent will send you an invoice for your required stay along with booking details</td>
            </tr>
            <tr>
              <td width="20" valign="top" align="left" style="font-size:14px;color:#047495">4.</td>
              <td valign="top" align="left" style="font-size:14px;color:#222222;padding-bottom:10px">Once you pay, the <?php echo SITENAME; ?> team will ensure that the your booking goes perfectly</td>
            </tr>
            <tr>
              <td width="20" valign="top" align="left" style="font-size:14px;color:#047495;padding-bottom:10px">5.</td>
              <td valign="top" align="left" style="font-size:14px;color:#222222">Enjoy your stay!</td>
            </tr>
          </tbody>
        </table></td>
    </tr>
    <tr>
      <td height="10">&nbsp;</td>
    </tr>

  </tbody>
</table>