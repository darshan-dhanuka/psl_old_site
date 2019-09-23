<section class="fantasyPage">
  <div class="container">
  <div class="row">
  <div class="col-xs-12" id="createTeam">
  <div class="teamtable">
<ul>
  <li class="">
    <div class="clTab tableHeadSec active" id="mentorList"><span class="addNum">0</span>
      <span class="tableHeading">MENTORS</span></div>
  </li>
  <li class="">
    <div class="clTab tableHeadSec" id="proList"><span class="addNum">0</span>
      <span class="tableHeading">PRO PLAYERS</span></div>

  </li>
  <li class="">
    <div class="clTab tableHeadSec" id="liveList"><span class="addNum">0</span>
      <span class="tableHeading">LIVE QUALIFIERS</span></div>

  </li>
  <li class="">
    <div class="clTab tableHeadSec" id="onlineList"><span class="addNum">0</span>
      <span class="tableHeading">ONLINE QUALIFIERS</span>
    </div>
  </li>
  <li class="">
    <div class="clTab tableHeadSec" id="wildList"><span class="addNum">0</span>
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
    foreach($mentor_list as $mentor){ ?>
    <tr class="player_name_<?php echo $mentor['id']; ?>">
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
    foreach($pro_list as $pro){ ?>
    <tr class="player_name_<?php echo $pro['id']; ?>">
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
    foreach($live_qualifier_list as $live_qualifier){ ?>
    <tr class="player_name_<?php echo $live_qualifier['id']; ?>">
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
    foreach($online_qualifier_list as $online_qualifier){ ?>
    <tr class="player_name_<?php echo $online_qualifier['id']; ?>">
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
    foreach($wildcard_list as $wildcard){ ?>
    <tr class="player_name_<?php echo $wildcard['id']; ?>">
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
<div class="text-center">
  <div class="teamListprev">TEAM PREVIEW</div>
  <div class="selectedTeam">
    <div class="col-xs-12 mentorHere">
      <img src="../images/fantasy1.png" alt="">
      <div class="namesAdd"><span>1 MENTOR</span></div>
    </div>
    <div class="col-xs-6 col-sm-3 proHere"><img src="../images/fantasy2.png" alt="">
      <div class="namesAdd">
      <span>2 PRO PLAYERS</span>
    </div>

    </div>
    <div class="col-xs-6 col-sm-3 liveHere"><img src="../images/fantasy3.png" alt="">
      <div class="namesAdd">
      <span>2 LIVE QUALIFIERS</span>
    </div>


    </div>
    <div class="col-xs-6 col-sm-3 onlineHere"><img src="../images/fantasy4.png" alt="">
      <div class="namesAdd">
      <span>3 ONLINE QUALIFIERS</span>
    </div>

    </div>
    <div class="col-xs-6 col-sm-3 wildHere"><img src="../images/fantasy5.png" alt="">
      <div class="namesAdd">
      <span>2 WILD CARDS</span>
    </div>
    </div>
     </div>
</div>
<div class="text-center">
<div class="clr"></div>
    <div class="viewTeam">TEAM PREVIEW</div>
     <div class="btnteamSec">
      <div class="txtfield">
        <input name="team_name" id="fantasy_team_name" type="text" placeholder="Enter Your Team’s Name Here">
      </div>
    <div class="submitBtn">
      <button class="btn customBtn midBtn" id="submitTeam" type="submit">Submit</button>
    </div>
  </div>
</div>
</div>
</div>
</div>
</section>

