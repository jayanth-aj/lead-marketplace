<style>
.card{
    <?php $background = plugins_url('payumoney/background.png',__FILE__); ?>
    background-image: url("<?php echo $background;?>");
}
</style>

<?php
  add_shortcode('educash_payment','educash_payment');
  function educash_payment($atts,$content = null)
  {
      if(is_user_logged_in())
      {
        global $current_user;
        get_currentuserinfo();
        $out = get_option("current_rate");
        $conversion=$out['rate'];
        $credentials = get_option("payumoney_parameters");
        //echo $credentials['password'];

        $next_page = plugins_url('payumoney/PayUMoney_form.php',__FILE__);
        $failure = plugins_url('payumoney/failure.php',__FILE__);
        $success = plugins_url('payumoney/success.php',__FILE__);
        $payumoney_logo = plugins_url('payumoney/PayUMoney_logo.png',__FILE__);
        $netbanking_logo = plugins_url('payumoney/netbanking.png',__FILE__);


        ?>

        <div class="card" ng-app="" ng-init="amount='0';">
          <div class ="card2">
            <form name="tranaction_form" method="post" action="">

              <input name="email" id="email" value="<?php echo $current_user->user_email; ?>" type="hidden" />
              <input name="firstname" id="firstname" value="<?php echo $current_user->user_firstname; ?>" type="hidden" />
              <input name="lastname" id="lastname" value="<?php echo $current_user->user_lastname; ?>" type="hidden" />
              <input name="txnid" id="txnid" value="<?php echo $credentials['password'];  ?>" type="hidden"/>
              <input name="rate" id="rate" value="<?php echo $conversion; ?>" type="hidden"/>
              <input name="saltid" id="saltid" value="<?php echo $credentials['user_id']; ?>" type="hidden"/>
              <input name="surl " id="surl" value="<?php echo $success; ?>" type="hidden"/>
              <input name="furl" id="furl" value="<?php echo $failure; ?>" type="hidden"/>

              <b><span class="heading1">Enter number of educash you want</span></br></b>
              <br><div class="inputbox1"><input  ng-model="amount" type="number" name="amount" placeholder="0" style="font-size: 23pt; text-align: center;" required/></div>
              <div class="output_amount"><b>Total =  {{amount*<?php echo $conversion; ?>}} Rs. </b></div>
              <b><h3><p class="conversion">*(1 educash is equal to <?php echo $conversion; ?> Rs)</p></h3></b></br>
              <b><span class="heading1">Please select Payment Method </span></b></br></br>
              <button onClick=this.form.action="<?php echo $next_page;?>" class="button1"><img src="<?php echo $payumoney_logo;?>"></img></button>
            </form>
          </div>
       </div>
      <?php
      }
      else{
        echo "please login to view this page";
      }
  }
?>
