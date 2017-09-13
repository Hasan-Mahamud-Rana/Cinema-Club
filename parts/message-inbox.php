<?php
if ( is_bkdk_user_logged_in() != true ) {
wp_redirect(site_url().'/login/');
}
$messages = get_all_messages( get_customerid() );

$findReplace = findReplace();
$findDate = $findReplace[0];
$replaceDate = $findReplace[1];
?>
<div class="message-panel" style="display:none;">
  <div class="row messageSection" >
    <div class="large-12">
      <ul class="accordion" data-accordion data-allow-all-closed="true">
        <?php
        foreach($messages as $message){
        $receivedDate = $message->date;
        $receivedDate=date_create($receivedDate);
        $date = new DateTime(date_format($receivedDate, "l d. F Y") );
        ?>
        <li id="<?php echo $message->systemmessageid; ?>" class="accordion-item" data-accordion-item>
          <a href="#" class="accordion-title">
            <?php

            echo '<p class="messageDate dkDate">' . str_replace( $findDate, $replaceDate, $date->format("l d. F Y"));
              if ($message->first_read_at == NULL || $message->first_read_at == ' '){
              echo '  <span class="unread">Ny besked</span></p>';
              } else {
            echo '</p>';
            }
            echo '<h4 class="messageSubject">'. $message->subject . '</h4>';
            echo '<div class="messageIntro">'. ttruncat($message->body, 150). '</div>';
            ?>
          </a>
          <div class="accordion-content" data-tab-content>
            <?php
            //echo 'first_read_at: ' . $message->first_read_at . '<br/>';
            echo $message->body . '<br/>';
            ?>
            <a class="button callSpin" href="<?php echo site_url(); ?>/delete-message?systemmessageid=<?php echo $message->systemmessageid; ?>">Slet Besked</a>
          </div>
        </li>
        <?php
        }
        ?>
      </ul>
    </div>
  </div>
  <div class="row" >
    <div class="large-12">
      <?php if (empty($messages)) {
      echo '<br><br><h4>Du har ingen beskeder lige nu.</h4><br/>';
      echo '<a class="button callSpin" href="'.site_url().'">Tilbage Til Forside</a>';
      }
      ?>
    </div>
  </div>
</div>
<script type="text/javascript"> 
function bindMarkAsReadEvent()
{
  jQuery("ul.accordion>li").off("click").on("click", function(){
  var siteUrl = '<?php echo site_url() ;?>';
  var systemmessageid = jQuery(this).attr('ID');
  //alert (systemmessageid);
  jQuery(this).children('a').children('p.messageDate').children('span.unread').addClass('hide');
  jQuery.ajax(siteUrl + "/mark-as-read/?message_id=" + systemmessageid).done();
  });
}
bindMarkAsReadEvent();
</script>