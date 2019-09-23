      <div class="col-xs-6 col-sm-10 col-lg-9">
        <div class="loginSec">
        <ul class="social">
            <li><a target="_blank" href="https://www.facebook.com/PokerSportsLeague" class="fbIcn"></a></li>
            <li><a target="_blank" href="https://plus.google.com/112677926005716550074" class="gplusIcn"></a></li>
            <li><a target="_blank" href="https://twitter.com/PSL_Ind" class="twitIcn"></a></li>
          </ul>
          <ul class="logs">
          <?php if ($this->session->checkLogin() == TRUE) {
              ?><li class="myact"><a href="javascript:;">Hi <?php echo $this->session->userdata('username');?>&nbsp;&nbsp;</a>
                  <ul class="submenu">
                      <li><a href="/my-account">My Account</a></li>
                      <li><a href="/change-password">Change Password</a></li>
                  </ul>
              </li>
              <li><a href="/logout">Logout</a></li><?php
            }else{?>
            <li><a href="/login">Login</a></li>
            <li><a href="/register">register</a></li>
            <?php }?>
          </ul>
          
        </div>
