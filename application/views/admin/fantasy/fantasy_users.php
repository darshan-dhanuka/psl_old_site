<!-- top tiles -->
<div class="data">
  <h2>Fantasy Users Score </h2>
</div>
<div class="data">
  <div style="min-height: 50px">
    <?php echo $this->session->flashdata('msg');?>
  </div>
  <div style="float:right;">
Day
      <select id="psl_score_day">
      <?php
      for($i=1;$i<= PSL_SCORE_DAY;$i++){
        $selected = '';
        if($i==$_GET['day'])
        {
          $selected = 'selected';
        }
      ?>
      <option value='<?php echo $i; ?>' <?php echo $selected; ?> >Day <?php echo $i; ?></option>
      <?php 
      }
      ?>
      </select>
  </div>
</div>
<!--Display Search List-->
<div class="col-md-12">
      <ul class="nav nav-tabs">       
        <li>
          <a href="/admin/fantasy">Upload Score</a>
        </li>
        <li class="active">
          <a>Fantasy User score</a>
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
              <th>Score</th>
            </tr>
          </thead>
          <tbody>
          <?php if ($user_details) { ?>
          <?php foreach ($user_details as $data) { ?>
            <tr>
              <td>
                <?php echo $data['player_id'];?>
              </td>
              <td>
                <?php echo $data['player_name'];?>
              </td>
               <td>
                <?php echo $data['category'];?>
              </td>
              <td>
                <?php echo $data['team_name'];?>
              </td>
              <td>
                <input readonly type="text"   value="<?php echo $data['score'];?>" id="score_<?php echo $data['id']; ?>">
                <button id="edit_score_<?php echo $data['id']; ?>" row_id ="<?php echo $data['id']; ?>">Edit</button>
                <button id="submitscore_<?php echo $data['id']; ?>" row_id="<?php echo $data['id']; ?>" style="display:none">Submit</button>
              </td>
            </tr>
          <?php }
          }
          ?>
          </tbody>
        </table>
      </div>
</div>
