<template>
  <div class="#">
    <!-- Right Panel -->
    <div class="user-area dropdown float-right">

      <div class="user-menu dropdown-menu">
        <a
          class="nav-link"
          href="#"
        ><i class="fa fa- user"></i>My Profile</a>

        <a
          class="nav-link"
          href="#"
        ><i class="fa fa- user"></i>Notifications <span class="count">13</span></a>

        <a
          class="nav-link"
          href="#"
        ><i class="fa fa -cog"></i>Settings</a>

        <a
          class="nav-link"
          href="#"
        ><i class="fa fa-power -off"></i>Logout</a>
      </div>
    </div>
    <!-- /#header -->
    <!-- Content -->
    <div class="content">
      <!-- Animated -->
      <div class="animated fadeIn">
        <!-- Widgets  -->
        <div class="row">
          <div class="col-lg-3 col-md-6">
            <div class="card">
              <div class="card-body">
                <div class="stat-widget-five">
                  <div class="stat-icon dib flat-color-1">
                    <i
                      class='fas fa-edit'
                      style='font-size:24px'
                    ></i>
                  </div>
                  <div class="stat-content">
                    <div class="text-left dib">
                      <div class="stat-text">Publiez votre CV<span class="count"></span></div>
                      <div class="stat-heading"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="card">
              <div class="card-body">
                <div class="stat-widget-five">
                  <div class="stat-icon dib flat-color-2">

                    <i
                      class='fas fa-wrench'
                      style='font-size:24px'
                    ></i>
                  </div>
                  <div class="stat-content">
                    <div class="text-left dib">
                      <div class="stat-text"><span class="count"></span></div>
                      <div class="stat-heading">Modifier mes informations personnelles</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="card">
              <div class="card-body">
                <div class="stat-widget-five">
                  <div class="stat-icon dib flat-color-3">
                    <i
                      class='far fa-eye'
                      style='font-size:24px'
                    ></i>
                  </div>
                  <div class="stat-content">
                    <div class="text-left dib">
                      <div class="stat-text"><span class="count"></span></div>
                      <div class="stat-heading">Consultez votre CV</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="card">
              <div class="card-body">
                <div class="stat-widget-five">
                  <div class="stat-icon dib flat-color-4">
                    <i class="fas fa-paste"></i>
                  </div>
                  <div class="stat-content">
                    <div class="text-left dib">
                      <div class="stat-text"><span class="count"></span></div>
                      <div class="stat-heading">Récapitulatif</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
        <!-- Orders -->
        <div class="orders">
          <div class="row">
            <div class="col-xl-8">
              <div class="card">
                <div class="card-body">
                  <h4 class="box-title">Mes activités recentes </h4>
                </div>
                <div class="card-body--">
                  <div class="table-stats order-table ov-h">
                    <table class="table ">
                      <thead>
                        <tr>
                          <th class="serial">#</th>

                          <th>ID</th>
                          <th>Name</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="serial">1.</td>
                          <td class="avatar">
                            <div class="round-img">
                              <a href="#"><img
                                  class="rounded-circle"
                                  src="images/avatar/1.jpg"
                                  alt=""
                                ></a>
                            </div>
                          </td>
                          <td> #5469 </td>
                          <td> <span class="name">Louis Stanley</span> </td>
                          <td>
                            <span class="badge badge-complete">Complete</span>
                          </td>
                        </tr>
                        <tr>
                          <td class="serial">2.</td>
                          <td class="avatar">
                            <div class="round-img">
                              <a href="#"><img
                                  class="rounded-circle"
                                  src="images/avatar/2.jpg"
                                  alt=""
                                ></a>
                            </div>
                          </td>
                          <td> #5468 </td>
                          <td> <span class="name">Gregory Dixon</span> </td>
                          <td>
                            <span class="badge badge-complete">Complete</span>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div> <!-- /.table-stats -->
                </div>
              </div> <!-- /.card -->
            </div> <!-- /.col-lg-8 -->
            <!-- /.col-md-4 -->
          </div>
        </div>
        <!-- /.orders -->
        <div class="col-sm-12 mb-4">
          <div class="card-group">
            <div class="card col-md-6 no-padding ">
              <div class="card-body">
                <div class="h1 text-muted text-right mb-4">
                  <i class="fa fa-users"></i>
                </div>

                <div class="h4 mb-0">
                  <span class="count">87500</span>
                </div>

                <small class="text-muted text-uppercase font-weight-bold">Visitors</small>
                <div
                  class="progress progress-xs mt-3 mb-0 bg-flat-color-1"
                  style="width: 40%; height: 5px;"
                ></div>
              </div>
            </div>
            <div class="card col-md-6 no-padding ">
              <div class="card-body">
                <div class="h1 text-muted text-right mb-4">
                  <i class="fa fa-user-plus"></i>
                </div>
                <div class="h4 mb-0">
                  <span class="count">385</span>
                </div>
                <small class="text-muted text-uppercase font-weight-bold">New Clients</small>
                <div
                  class="progress progress-xs mt-3 mb-0 bg-flat-color-2"
                  style="width: 40%; height: 5px;"
                ></div>
              </div>
            </div>
            <div class="card col-md-6 no-padding ">
              <div class="card-body">
                <div class="h1 text-muted text-right mb-4">
                  <i class="fa fa-cart-plus"></i>
                </div>
                <div class="h4 mb-0">
                  <span class="count">1238</span>
                </div>
                <small class="text-muted text-uppercase font-weight-bold">Products sold</small>
                <div
                  class="progress progress-xs mt-3 mb-0 bg-flat-color-3"
                  style="width: 40%; height: 5px;"
                ></div>
              </div>
            </div>
            <div class="card col-md-6 no-padding ">
              <div class="card-body">
                <div class="h1 text-muted text-right mb-4">
                  <i class="fa fa-pie-chart"></i>
                </div>
                <div class="h4 mb-0">
                  <span class="count">28</span>%
                </div>
                <small class="text-muted text-uppercase font-weight-bold">Returning Visitors</small>
                <div
                  class="progress progress-xs mt-3 mb-0 bg-flat-color-4"
                  style="width: 40%; height: 5px;"
                ></div>
              </div>
            </div>
            <div class="card col-md-6 no-padding ">
              <div class="card-body">
                <div class="h1 text-muted text-right mb-4">
                  <i class="fa fa-clock-o"></i>
                </div>
                <div class="h4 mb-0">5:34:11</div>
                <small class="text-muted text-uppercase font-weight-bold">Avg. Time</small>
                <div
                  class="progress progress-xs mt-3 mb-0 bg-flat-color-5"
                  style="width: 40%; height: 5px;"
                ></div>
              </div>
            </div>
            <div class="card col-md-6 no-padding ">
              <div class="card-body">
                <div class="h1 text-muted text-right mb-4">
                  <i class="fa fa-comments-o"></i>
                </div>
                <div class="h4 mb-0">
                  <span class="count">972</span>
                </div>
                <small class="text-muted text-uppercase font-weight-bold">COMMENTS</small>
                <div
                  class="progress progress-xs mt-3 mb-0 bg-flat-color-1"
                  style="width: 40%; height: 5px;"
                ></div>
              </div>
            </div>
          </div>
        </div>
        <!-- /#right-panel -->
      </div>
    </div>

    <div class="user-menu dropdown-menu">
      <a
        class="nav-link"
        href="#"
      ><i class="fa fa-user"></i>My Profile</a>

      <a
        class="nav-link"
        href="#"
      ><i class="fa fa-bell-o"></i>Notifications <span class="count">13</span></a>

      <a
        class="nav-link"
        href="#"
      ><i class="fa fa-cog"></i>Settings</a>

      <a
        class="nav-link"
        href="#"
      ><i class="fa fa-power-off"></i>Logout</a>
    </div>
  </div>
</template>
<script>
