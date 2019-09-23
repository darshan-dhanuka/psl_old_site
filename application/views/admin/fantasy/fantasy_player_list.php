<!-- top tiles -->
<div class="data">
  <h2>Fantasy Users Score </h2>
</div>
<div class="data">
  <div style="min-height: 50px">
    <?php echo $this->session->flashdata('msg');?>
  </div>
</div>
<!--Display Search List-->
<div class="col-md-12">
      <ul class="nav nav-tabs">       
        <li>
          <a href="/admin/fantasy/uploadPlayerList">Upload Players</a>
        </li>
        <li class="active">
          <a>Fantasy Player List</a>
        </li>
      </ul>
      <div style="overflow-x:scroll;max-height: 500px; overflow-y: scroll;">
        <table class="table table-bordered" id="exportTable">
          <thead>
            <tr>
              <th>ID</th>
              <th>Player Name</th>
              <th>Category</th>
              <th>Team</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          <?php if ($player_list) { ?>
          <?php foreach ($player_list as $player) { ?>
            <tr>
              <td>
                <?php echo $player['id'];?>
              </td>
              <td>
                <?php echo $player['player_name'];?>
              </td>
               <td>
                <?php echo $player['category'];?>
              </td>
              <td>
                <?php echo $player['team_name'];?>
              </td>
              <td>
                <button id="player_status_<?php echo $player['id']; ?>" row_id="<?php echo $player['id']; ?>" row_status="<?php echo $player['status']; ?>"><?php echo ($player['status']==1)?'Inactive':'Active'; ?></button>
              </td>
            </tr>
          <?php }
          }
          ?>
          </tbody>
        </table>
      </div>
</div>
