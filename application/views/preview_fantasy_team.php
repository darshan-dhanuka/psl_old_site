<section class="fantasyPage">
  <div class="container">
  <div class="row">
  <div class="col-xs-12" id="createTeam">
  <?php
  if($deadline_status)
  {
  ?>
  <div class="teamtable">
<ul>
  <li class="">
    <div class="clTab tableHeadSec active" id="mentorList"><span class="addNum">1</span>
      <span class="tableHeading">MENTORS</span></div>
  </li>
  <li class="">
    <div class="clTab tableHeadSec" id="proList"><span class="addNum">2</span>
      <span class="tableHeading">PRO PLAYERS</span></div>

  </li>
  <li class="">
    <div class="clTab tableHeadSec" id="liveList"><span class="addNum">2</span>
      <span class="tableHeading">LIVE QUALIFIERS</span></div>

  </li>
  <li class="">
    <div class="clTab tableHeadSec" id="onlineList"><span class="addNum">3</span>
      <span class="tableHeading">ONLINE QUALIFIERS</span>
    </div>
  </li>
  <li class="">
    <div class="clTab tableHeadSec" id="wildList"><span class="addNum">2</span>
      <span class="tableHeading">WILD CARDS</span>
    </div>

  </li>
</ul>

<div class="fantasyPlayers mentorList active">
<div class="tblWrapper">
<table class="table tableList">
  <thead>
    <tr>
      <th><span>Player</span></th>
      <th><span>Team</span></th>
      <th><span>Action</span></th>
    </tr>
  </thead>
<tbody>

  <?php 
  if(isset($mentor_list)){
    foreach($mentor_list as $mentor){ 
      $active = '';
      if(in_array($mentor['id'],explode(',',$mentor_data)))
      {
        $active = 'active';
      }
    ?>
    <tr class="player_name_<?php echo $mentor['id'].' '.$active; ?>">
      <td><?php echo $mentor['player_name']; ?></td>
      <td><?php echo $mentor['team_name']; ?></td>
      <td><a href='javascript:;' class="selectVal mentorhun" player_id="<?php echo $mentor['id']; ?>">+</a><a href='javascript:;' class="removeVal" player_id="<?php echo $mentor['id']; ?>">×</a></td>
    </tr>
    <?php }
  } ?>
</tbody>
</table>
</div>
<div class="selectInfo">Select only 1 player from the list</div>
</div>

<div class="fantasyPlayers proList">
<div class="tblWrapper">
<table class="table tableList">
  <thead>
    <tr>
      <th><span>Player</span></th>
      <th><span>Team</span></th>
      <th><span>Action</span></th>
    </tr>
  </thead>
<tbody>
   <?php 
  if(isset($pro_list)){
    foreach($pro_list as $pro){ 
      $active = '';
      if(in_array($pro['id'],explode(',',$pro_data)))
      {
        $active = 'active';
      }
    ?>
    <tr class="player_name_<?php echo $pro['id'].' '.$active; ?>">
      <td><?php echo $pro['player_name']; ?></td>
      <td><?php echo $pro['team_name']; ?></td>
      <td><a href='javascript:;' class="selectVal" player_id="<?php echo $pro['id']; ?>">+</a><a href='javascript:;' class="removeVal" player_id="<?php echo $pro['id']; ?>">×</a></td>
    </tr>
    <?php }
  } ?>
</tbody>
</table>
</div>
<div class="selectInfo">Select only 2 player from the list</div>
</div>

<div class="fantasyPlayers liveList">
<div class="tblWrapper">
<table class="table tableList">
  <thead>
    <tr>
      <th><span>Player</span></th>
      <th><span>Team</span></th>
      <th><span>Action</span></th>
    </tr>
  </thead>
<tbody>
  <?php 
  if(isset($live_qualifier_list)){
    foreach($live_qualifier_list as $live_qualifier){ 
      $active = '';
      if(in_array($live_qualifier['id'],explode(',',$lq_data)))
      {
        $active = 'active';
      }
    ?>
    <tr class="player_name_<?php echo $live_qualifier['id'].' '.$active; ?>">
      <td><?php echo $live_qualifier['player_name']; ?></td>
      <td><?php echo $live_qualifier['team_name']; ?></td>
      <td><a href='javascript:;' class="selectVal" player_id="<?php echo $live_qualifier['id']; ?>">+</a><a href='javascript:;' class="removeVal" player_id="<?php echo $live_qualifier['id']; ?>">×</a></td>
    </tr>
    <?php }
  } ?>
</tbody>
</table>
</div>
<div class="selectInfo">Select only 2 player from the list</div>
</div>

<div class="fantasyPlayers onlineList">
<div class="tblWrapper">
<table class="table tableList">
  <thead>
    <tr>
      <th><span>Player</span></th>
      <th><span>Team</span></th>
      <th><span>Action</span></th>
    </tr>
  </thead>
<tbody>
   <?php 
  if(isset($online_qualifier_list)){
    foreach($online_qualifier_list as $online_qualifier){ 
      $active = '';
      if(in_array($online_qualifier['id'],explode(',',$oq_data)))
      {
        $active = 'active';
      }
    ?>
    <tr class="player_name_<?php echo $online_qualifier['id'].' '.$active; ?>">
      <td><?php echo $online_qualifier['player_name']; ?></td>
      <td><?php echo $online_qualifier['team_name']; ?></td>
      <td><a href='javascript:;' class="selectVal" player_id="<?php echo $online_qualifier['id']; ?>">+</a><a href='javascript:;' class="removeVal" player_id="<?php echo $online_qualifier['id']; ?>">×</a></td>
    </tr>
    <?php }
  } ?>
</tbody>
</table>
</div>
<div class="selectInfo">Select only 3 player from the list</div>
</div>

<div class="fantasyPlayers wildList">
<div class="tblWrapper">
<table class="table tableList">
  <thead>
    <tr>
      <th><span>Player</span></th>
      <th><span>Team</span></th>
      <th><span>Action</span></th>
    </tr>
  </thead>
<tbody>
  <?php 
  if(isset($wildcard_list)){
    foreach($wildcard_list as $wildcard){ 
      $active = '';
      if(in_array($wildcard['id'],explode(',',$wildcard_data)))
      {
        $active = 'active';
      }
    ?>
    <tr class="player_name_<?php echo $wildcard['id'].' '.$active; ?>">
      <td><?php echo $wildcard['player_name']; ?></td>
      <td><?php echo $wildcard['team_name']; ?></td>
      <td><a href='javascript:;' class="selectVal" player_id="<?php echo $wildcard['id']; ?>">+</a><a href='javascript:;' class="removeVal" player_id="<?php echo $wildcard['id']; ?>">×</a></td>
    </tr>
    <?php }
  } ?>
</tbody>
</table>
</div>
<div class="selectInfo">Select only 2 player from the list</div>
</div>
</div>
<?php
}
?>
<div class="text-center">
  <div class="teamListprev">TEAM PREVIEW</div>
  <div class="selectedTeam" id="selectedTeam">
    <div class="col-xs-12 mentorHere">
      <img src="../images/fantasy1.png" alt="">
      <div class="namesAdd">
        <?php foreach($team_detail['mentor'] as $mentor ){ ?>
        <span class="proPName_<?php echo $mentor['player_id']; ?>">
          <?php echo $mentor['player_name']; ?>
          <?php if($deadline_status){ ?>
          <span class="closeParent" player_id="<?php echo $mentor['player_id']; ?>">x</span>
          <?php
          }
          ?>
        </span>
        <?php 
        }
        ?>
      </div>
    </div>
    <div class="col-xs-6 col-sm-3 proHere"><img src="../images/fantasy2.png" alt="">
      <div class="namesAdd">
      <?php foreach($team_detail['pro'] as $pro ){ ?>
      <span class="proPName_<?php echo $pro['player_id']; ?>">
        <?php echo $pro['player_name']; ?>
        <?php if($deadline_status){ ?>
          <span class="closeParent" player_id="<?php echo $pro['player_id']; ?>">x</span>
          <?php
          }
          ?>
      </span>
      <?php 
      }
      ?>
    </div>

    </div>
    <div class="col-xs-6 col-sm-3 liveHere"><img src="../images/fantasy3.png" alt="">
      <div class="namesAdd">
      <?php foreach($team_detail['live_qualifier'] as $live_qualifier ){ ?>
      <span class="proPName_<?php echo $pro['player_id']; ?>">
        <?php echo $live_qualifier['player_name']; ?>
        <?php if($deadline_status){ ?>
          <span class="closeParent" player_id="<?php echo $live_qualifier['player_id']; ?>">x</span>
          <?php
          }
          ?>
      </span>
      <?php 
      }
      ?>
    </div>


    </div>
    <div class="col-xs-6 col-sm-3 onlineHere"><img src="../images/fantasy4.png" alt="">
      <div class="namesAdd">
      <?php foreach($team_detail['online_qualifier'] as $online_qualifier ){ 
      ?>
      <span class="proPName_<?php echo $online_qualifier['player_id']; ?>">
        <?php echo $online_qualifier['player_name']; ?>
        <?php if($deadline_status){ ?>
          <span class="closeParent" player_id="<?php echo $online_qualifier['player_id']; ?>">x</span>
          <?php
          }
          ?>
      </span>
      <?php 
      }
      ?>
    </div>

    </div>
    <div class="col-xs-6 col-sm-3 wildHere"><img src="../images/fantasy5.png" alt="">
      <div class="namesAdd">
      <?php foreach($team_detail['wildcard'] as $wildcard ){ ?>
      <span class="proPName_<?php echo $wildcard['player_id']; ?>">
        <?php echo $wildcard['player_name']; ?>
        <?php if($deadline_status){ ?>
          <span class="closeParent" player_id="<?php echo $wildcard['player_id']; ?>">x</span>
          <?php
          }
          ?>
      </span>
      <?php 
      }
      ?>
    </div>
    </div>
     </div>
</div>
<div class="text-center">
<div class="clr"></div>
    <div class="viewTeam">TEAM PREVIEW</div>
     <div class="btnteamSec">
      <div class="txtfield">
        <input name="team_name" id="fantasy_team_name" type="text" value="<?php echo $team_name; ?>" disabled placeholder="Enter Your Team’s Name Here">
      </div>
    <div class="submitBtn">
      <?php if($deadline_status){
        ?>
        <button class="btn customBtn midBtn dontSubmit" id="submitTeam" type="submit">Submit</button>
        <?php
        }?>
    </div>
  </div>
</div>


</div>
</div>
</div>
</section>

