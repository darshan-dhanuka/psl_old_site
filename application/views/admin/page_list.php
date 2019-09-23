
<!DOCTYPE html>
<html lang="en">
 <?php $this->load->view('admin/head') ?>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
       <?php $this->load->view('admin/left_bar') ?>

        <!-- top navigation -->
        <div class="top_nav">
         <?php $this->load->view('admin/header'); ?>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row">
            <!--Page Body Start-->         
            <div class="col-md-12">
              <div class="tabbable" id="tabs-491480">
                <ul class="nav nav-tabs">
                  <li class="active">
                    <a href="#panel-565085" data-toggle="tab">Website Page</a>
                  </li>
                  <li>
                    <a href="#panel-649081" data-toggle="tab">Add New Page</a>
                  </li>
                </ul>
                <!--Page Edit Model-->
                <div class="modal fade" id="modal-container-348960" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                          ×
                        </button>
                        <h4 class="modal-title" id="myModalLabel">
                          Edit Page
                        </h4>
                      </div>
                      <div class="modal-body">
                          <form role="form">
                            <div class="form-group">                    
                              <label for="page_url">Page URL</label>
                              <div class="input-group">
                                <span id="basic-addon3" class="input-group-addon">https://example.com/users/</span>
                                <input id="page_url" class="form-control" aria-describedby="basic-addon3" type="text" />
                              </div>
                            </div>
                            <div class="form-group">
                              
                              <label for="page_title">
                                Page Title
                              </label>
                              <input id="page_title" class="form-control" type="text" />
                            </div>
                            <div class="form-group">
                              
                              <label for="seo_title">
                                Seo Title
                              </label>
                              <input id="seo_title"  class="form-control" type="text" />
                            </div>
                            <div class="form-group">
                              
                              <label for="seo_description">
                                Seo Description
                              </label>
                              <textarea class="form-control" rows="5" id="seo_description"></textarea>
                            </div>
                            <div class="form-group">
                              
                              <label for="seo_keyword">
                                Seo Keyword
                              </label>
                              <textarea class="form-control" rows="5" id="seo_keyword"></textarea>
                            </div>
                            <div class="form-group">
                              
                              <label for="navigation_bar_title">
                                navigation bar title
                              </label>
                              <input id="navigation_bar_title" class="form-control" type="text" />
                            </div>
                            <div class="form-group">
                              
                              <label for="excerpt">
                                Excerpt
                              </label>
                              <input id="excerpt" class="form-control" type="text"  />
                            </div>
                            <div class="form-group">
                              
                              <label for="page_type">
                                Page Type
                              </label>
                              <select id="page_type" name="page_type">
                                <option>Select</option>
                                <option value="1">Content</option>
                                <option value="2">Tabular</option>
                                <option value="3">Image text</option>
                              </select>
                            </div>
                            <div class="form-group">
                              
                              <label for="special_offer">
                                Special offer
                              </label>
                              <input id="special_offer" name="offer_type" type="radio"  />
                              <label for="near_buy">
                                Near buy
                              </label>
                              <input id="near_buy" name="offer_type" type="radio"  />
                            </div>
                            <div class="form-group">
                              
                              <label for="menu_type">
                                Menu Type
                              </label>
                              <select id="menu_type" name="menu_type">
                                <option value="0">None</option>
                                <option value="1">Left Menu1</option>
                                <option value="2">Left Menu2</option>
                              </select>
                            </div>
                            <div class="form-group">
                              
                              <label for="featured_image">
                                Featured Image
                              </label>
                              <input id="featured_image" type="file"  />
                            </div>
                            <div class="form-group">
                              
                              <label for="sequence">
                                Sequence
                              </label>
                              <input id="sequence" class="form-control" type="text"  />
                            </div>
                            <div class="checkbox">
                              
                              <label>
                                <input type="checkbox" name="is_featured" /> Display on home page
                              </label>
                            </div>
                          </form>             
                      </div>
                      <div class="modal-footer">
                        
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                          Close
                        </button> 
                        <button type="button" class="btn btn-primary">
                          Save changes
                        </button>
                      </div>
                    </div>
                    
                  </div>
                  <!--Page Edit Model-->
                </div>
                <div class="tab-content">
                  <div class="tab-pane active" id="panel-565085">
                    <table class="table table-bordered table-hover table-condensed">
                      <thead>
                        <tr>
                          <th>
                            #
                          </th>
                          <th>
                            Page Title
                          </th>
                          <th>
                              Modified On
                          </th>
                          <th>
                            Author
                          </th>
                          <th>
                            Action
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php 
                      if(count($page_list)){
                        $i=0;
                        foreach($page_list as $row){$i++;
                        ?>
                        <tr>
                          <td>
                            <?php echo $i;?>
                          </td>
                          <td>
                            <?php echo $row['page_name'];?>
                          </td>
                          <td>
                            <?php echo date("d-M-Y h:i:s A", strtotime($row['modified_on']))?>
                          </td>
                          <td>
                            <?php echo $row['author'];?>
                          </td>
                          <td>
                            <a id="modal-348960" href="#modal-container-348960" role="button" data-toggle="modal" class="btn btn-primary">Edit</a>
                            <button type="button" class="btn btn-danger">Delete</button>
                          </td>
                        </tr>
                      <?php }}?>  
                      </tbody>
                      <!--<tfoot>
                        <tr><td colspan="5">
                        <ul class="pagination">
                          <li>
                            <a href="#">Prev</a>
                          </li>
                          <li>
                            <a href="#">1</a>
                          </li>
                          <li>
                            <a href="#">2</a>
                          </li>                 
                          <li>
                            <a href="#">Next</a>
                          </li>
                        </ul>
                        </td></tr>
                      </tfoot>-->
                    </table>
                  </div>
                  <div class="tab-pane" id="panel-649081">
                    <div class="row">
                      
                      <div class="col-md-12">
                        <form role="form">
                          <div class="form-group">
                            
                            <label for="page_url">
                              Page URL
                            </label>
                            <div class="input-group">
                              <span id="basic-addon1" class="input-group-addon">https://example.com/users/</span>
                              <input id="page_url" class="form-control" aria-describedby="basic-addon1" type="text" />
                            </div>
                          </div>
                          <div class="form-group">
                            
                            <label for="page_title">
                              Page Title
                            </label>
                            <input id="page_title" class="form-control" type="text" />
                          </div>
                          <div class="form-group">
                            
                            <label for="seo_title">
                              Seo Title
                            </label>
                            <input id="seo_title"  class="form-control" type="text" />
                          </div>
                          <div class="form-group">
                            
                            <label for="seo_description">
                              Seo Description
                            </label>
                             <textarea class="form-control" rows="5" id="seo_description"></textarea>
                          </div>
                          <div class="form-group">
                            
                            <label for="seo_keyword">
                              Seo Keyword
                            </label>
                            <textarea class="form-control" rows="5" id="seo_keyword"></textarea>
                          </div>
                          <div class="form-group">
                            
                            <label for="navigation_bar_title">
                              navigation bar title
                            </label>
                            <input id="navigation_bar_title" class="form-control" type="text" />
                          </div>
                          <div class="form-group">
                            
                            <label for="excerpt">
                              Excerpt
                            </label>
                            <input id="excerpt" class="form-control" type="text"  />
                          </div>
                          <div class="form-group">
                            
                            <label for="page_type">
                              Page Type
                            </label>
                            <select id="page_type" name="page_type">
                              <option>Select</option>
                              <option value="1">Content</option>
                              <option value="2">Tabular</option>
                              <option value="3">Image text</option>
                            </select>
                          </div>
                          <div class="form-group">
                            
                            <label for="special_offer">
                              Special offer
                            </label>
                            <input id="special_offer" name="offer_type" type="radio"  />
                            <label for="near_buy">
                              Near buy
                            </label>
                            <input id="near_buy" name="offer_type" type="radio"  />
                          </div>
                          <div class="form-group">
                            
                            <label for="menu_type">
                              Menu Type
                            </label>
                            <select id="menu_type" name="menu_type">
                              <option value="0">None</option>
                              <option value="1">Left Menu1</option>
                              <option value="2">Left Menu2</option>
                            </select>
                          </div>
                          <div class="form-group">
                            
                            <label for="featured_image">
                              Featured Image
                            </label>
                            <input id="featured_image" type="file"  />
                          </div>
                          <div class="form-group">
                            
                            <label for="sequence">
                              Sequence
                            </label>
                            <input id="sequence" class="form-control" type="text"  />
                          </div>
                          <div class="checkbox">
                            
                            <label>
                              <input type="checkbox" name="is_featured" /> Display on home page
                            </label>
                          </div> 
                          <button type="submit" class="btn btn-default">
                            Submit
                          </button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <!--Page Body End-->
          </div>
          <!-- /top tiles -->

        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            <a href="">PSL</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo ADMIN_JS_PATH;?>/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo ADMIN_JS_PATH;?>/bootstrap.min.js"></script>    
    <!-- Custom Theme Scripts -->
    <script src="<?php echo ADMIN_JS_PATH;?>/custom.min.js"></script>



  </body>
</html>
