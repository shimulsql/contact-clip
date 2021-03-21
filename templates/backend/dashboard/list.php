<div class="list-items-wrap">
            <div class="list-actions">
              <div class="row">
                <div class="col-md-3 col-sm-6">
                  <form class="action-items" action="">
                    <select class="custom-select mr-sm-2" id="action-select">
                      <option selected>Choose...</option>
                      <option value="1">Delete</option>
                      <option value="2">Edit</option>
                    </select>
                    <button type="submit" class="btn btn-primary">
                      <i class="fas fa-location-arrow"></i>
                    </button>
                  </form>
                </div>
                <div class="col-md-3 col-sm-6">
                  <select class="custom-select mr-sm-2 filter-items" id="filter-select">
                    <option selected>Filter By...</option>
                    <option value="name">Name</option>
                    <option value="phone">Phone</option>
                    <option value="bloodGroup">Blood Group</option>
                  </select>
                </div>
                <div class="col-md-6 col-sm-12">
                  <input class="search-items form-control" type="text" name="" id="" placeholder="Type to search">
                </div>
              </div>
            </div>
            <table class="table list-items">
              <thead class="bg-primary text-white">
                <tr>
                  <th scope="col"><input type="checkbox" name="check-all" id=""></th>
                  <th scope="col">Name</th>
                  <th scope="col">Number</th>
                  <th scope="col">Photo</th>
                  <th scope="col"><i class="fas fa-tools"></i></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row"><input type="checkbox" name="" id=""></th>
                  <td><a href="view-contact.php">Mark</a></td>
                  <td>0178959955</td>
                  <td><div class="thumb">
                    <img class="list-thumb" src="<?php get_asset_path(); ?>images/avatar.jpg" alt="">
                    <div class="info-one">O+</div>
                  </div></td>
                  <td><a href="edit-contact.php"><i class="far fa-edit"></i></a></td>
                </tr>
                <tr>
                  <th scope="row"><input type="checkbox" name="" id=""></th>
                  <td><a href="view-contact.php">Dany</a></td>
                  <td>0178959955</td>
                  <td><div class="thumb">
                    <img class="list-thumb" src="<?php get_asset_path(); ?>images/avatar.jpg" alt="">
                    <div class="info-one">O+</div>
                  </div></td>
                  <td><a href="edit-contact.php"><i class="far fa-edit"></i></a></td>
                </tr>
                <tr>
                  <th scope="row"><input type="checkbox" name="" id=""></th>
                  <td><a href="view-contact.php">Joe</a></td>
                  <td>0178959955</td>
                  <td><div class="thumb">
                    <img class="list-thumb" src="<?php get_asset_path(); ?>images/avatar.jpg" alt="">
                    <div class="info-one">O+</div>
                  </div></td>
                  <td><a href="edit-contact.php?"><i class="far fa-edit"></i></a></td>
                </tr>

              </tbody>
            </table>
            <nav aria-label="Page navigation example">
              <ul class="pagination justify-content-end">
                <li class="page-item disabled">
                  <a class="page-link" href="#" tabindex="-1" aria-disabled="true">&laquo;</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                  <a class="page-link" href="#">&raquo;</a>
                </li>
              </ul>
            </nav>
          </div>