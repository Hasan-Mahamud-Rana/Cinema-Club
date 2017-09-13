<?php
if ( is_bkdk_user_logged_in() != true ) {
  wp_redirect(site_url().'/login/');
}
$customerid = get_customerid();
$userDetails = get_user_info($customerid);
$lottery_tickets_amount_sum = $userDetails->lottery_tickets_amount_sum;
$lotteryDetails = get_lottery_details($customerid);

$findReplace = findReplace();
$findDate = $findReplace[0];
$replaceDate = $findReplace[1];
/*
function remainingTime(){
  $prize_draw_date = get_field('prize_draw_date');
  $prize_draw_time = get_field('prize_draw_time');
  //$draw = "2016-09-16 23:40:00";
  //$interval = date_diff(date_create(), date_create($draw));
  //$out = $interval->format("%d days %M months %Y years %H hours %s seconds");
  //$diff = strtotime($out) - time();
  $draw = $prize_draw_date . ' ' . $prize_draw_time;
  $now = date("Y-m-d h:i:s");
  $drawString = strtotime($draw);
  $nowString = strtotime($now);
  $seconds_diff = $drawString - $nowString;
  $diffm = $seconds_diff * 1000;
  $remaining_time = "remaining_time";
  update_field($remaining_time, $diffm);
  return $seconds_diff;
}
$countDown = remainingTime();*/

$prize_draw_date = get_field('prize_draw_date');
$fulldate = explode("-", $prize_draw_date);
$year = $fulldate[0];
$month = $fulldate[1] - 1;
$day = $fulldate[2];

$prize_draw_time = get_field('prize_draw_time');
$fulltime = explode(":", $prize_draw_time);
$hours = $fulltime[0];
$minutes = $fulltime[1];
$seconds = $fulltime[2];
?>
<div class="myLotteryTickets-panel">
  <div class="row lotteryContent" data-equalizer>
    <div class="small-12 medium-6 large-6 columns" data-equalizer-watch>
      <div class="yellowBox">
        <p>DU HAR SAMLET</p>
        <h1><?php echo $lottery_tickets_amount_sum; ?></h1>
        <p>LODDER</p>
      </div>
    </div>
    <div class="small-12 medium-6 large-6 columns" data-equalizer-watch>
      <div class="blackBox">
        <p>NÆSTE LODTRÆKNING ER OM:</p>
        <div class="clock"></div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="small-12 columns" >
      <hr class="magentaBorder">
    </div>
  </div>
  <?php get_template_part( 'parts/lottery-tickets', 'win' ); ?>
  <div class="lottery-panel">
    <div class="row" >
      <div class="large-12 columns">
        <h5>Sådan har du samlet dine seneste lodder:</h5>
      </div>
    </div>
    <div class="row lottery-packages small-up-1 medium-up-3 large-up-4">
      <?php
      foreach($lotteryDetails as $lotteryDetail)
      {
      echo '<div class="column">';
        $validto = $lotteryDetail->date;
        $validtoDate=date_create($validto);
        $date = new DateTime(date_format($validtoDate, "l d. F Y") );
        echo '<p class="date dkDate">' . str_replace( $findDate, $replaceDate, $date->format("l d. F Y")) . '</p>';
        echo '<div>';
          $amount = $lotteryDetail->amount;
          $description =  $lotteryDetail->description;
          echo '<span class="amount">' . $amount. '</span>';
          echo '<span class="description">' . $description . '</span>';
          echo '<span class="clear"></span>';
        echo '</div></div>';
        }
        ?>
      </div>
      <div class="row" >
        <div class="small-12 columns text-right lotteryReadMore">
          <p><a class="front" data-open="lotteryConfirmation" >Læs mere om lodder og betingelser</a></p>
        </div>
      </div>
    </div>
  </div>
  <div class="large-12 columns">
    <?php $query = new WP_Query( array( 'page_id' => 184, 'post_status' => 'publish' , 'posts_per_page' => 1 ) ); ?>
    <?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
    <div class="reveal" id="lotteryConfirmation" aria-labelledby="exampleModalHeader11" data-reveal>
      <p class="overlayHeading"><?php the_title(); ?></p>
      <div class="small-12 FilmpakkenPopUp">
        <?php the_content(); ?>
        <button class="close-button" data-close aria-label="Close modal" type="button">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
    </div>
    <?php endwhile;  wp_reset_postdata(); else : ?>
    <?php _e( 'Sorry, no posts matched your criteria.' ); ?>
    <?php endif; ?>
  </div>

<script type="text/javascript">
jQuery(document).ready(function() {

var y = '<?php echo $year ;?>';
var m = '<?php echo $month ;?>';
var d = '<?php echo $day ;?>';

var h = '<?php echo $hours ;?>';
var min = '<?php echo $minutes ;?>';
var s = '<?php echo $seconds ;?>';

var date  = new Date(Date.UTC(y, m, d, h, min, s));
var now   = new Date();
var diff  = date.getTime()/1000 - now.getTime()/1000;
var clock = jQuery('.clock').FlipClock(diff, {
    clockFace: 'DailyCounter',
    language: 'da',
    countdown: true
  });
});
  </script>