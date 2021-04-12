<section class="admin-wrap d-flex justify-content-start">
      <!-- Sidebar -->
      <?php get_sidebar('group') ?>
      <div class="admin-content-wrap">
        <div class="container">
          <div class="d-section-heading">
            <i class="far fa-ellipsis-v"></i> 
            Groups
          </div>
          <!-- Contents start -->
          <div class="list-items-wrap">
            
            <div class="row">
                <div class="col-md-7 col-sm-12 order-2 order-sm-1">
                  <table class="table list-items">
                    <thead class="bg-primary text-white">
                      <tr>
                        <th scope="col">Name</th>
                        <th scope="col"><i class="fas fa-tools"></i></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Mark</td>
                        <td>
                            <a href="edit.php?"><i class="far fa-edit"></i></a>
                            <a href="#"><i class="far fa-remove"></i></a>
                          </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="col-md-5 col-sm-12 order-1 order-sm-2 mb-3">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">Add group</h5>
                      <form action="" id="group-form">
                        <div class="d-flex align-items-start" >
                          <div class="mr-4" style="width:85%">
                            <input type="text" name="name" class="form-control" placeholder="Type name..">
                            <div class="invalid-feedback"></div>
                          </div>
                          <input type="submit" class="btn btn-primary" value="Add">
                        </div>
                      </form>
                      
                    </div>
                  </div>
                  <div class="display-response alert mt-3"></div>
                </div>
            </div>

          </div>
         
        </div>
      </div>
    </section>

    <style>
      .display-response{
        display: none;
      }
    </style>