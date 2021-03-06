<?php include 'header.php'; ?>
<div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
          <h3 class="content-header-title mb-0">Toastr</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="#">Extra Components</a>
                </li>
                <li class="breadcrumb-item active">Toastr
                </li>
              </ol>
            </div>
          </div>
        </div>
        <div class="content-header-right col-md-6 col-12">
          <div role="group" aria-label="Button group with nested dropdown" class="btn-group float-md-right">
            <div role="group" class="btn-group">
              <button id="btnGroupDrop1" type="button" data-toggle="dropdown" aria-haspopup="true"
              aria-expanded="false" class="btn btn-outline-primary dropdown-toggle dropdown-menu-right"><i class="ft-settings icon-left"></i> Settings</button>
              <div aria-labelledby="btnGroupDrop1" class="dropdown-menu"><a href="card-bootstrap.html" class="dropdown-item">Bootstrap Cards</a>
                <a href="component-buttons-extended.html" class="dropdown-item">Buttons Extended</a>
              </div>
            </div>
            <a href="full-calender-basic.html" class="btn btn-outline-primary"><i class="ft-mail"></i></a>
            <a href="timeline-center.html" class="btn btn-outline-primary"><i class="ft-pie-chart"></i></a>
          </div>
        </div>
      </div>
      <div class="content-body">
        <!-- Types section start -->
        <section id="types">
          <div class="row">
            <div class="col-12 mt-3 mb-1">
              <h4 class="text-uppercase">Types</h4>
            </div>
          </div>
          <div class="card">
            <div class="card-content">
              <div class="card-body">
                <div class="row mt-1">
                  <div class="col-md-6 col-sm-12">
                    <button type="button" class="btn btn-lg btn-block btn-outline-success mb-2" id="type-success">Success</button>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <button type="button" class="btn btn-lg btn-block btn-outline-info mb-2" id="type-info">Info</button>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 col-sm-12">
                    <button type="button" class="btn btn-lg btn-block btn-outline-warning mb-2" id="type-warning">Warning</button>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <button type="button" class="btn btn-lg btn-block btn-outline-danger mb-2" id="type-error">Error</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- // Types section end -->
        <!-- Position section start -->
        <section id="position">
          <div class="row">
            <div class="col-12 mt-3 mb-1">
              <h4 class="text-uppercase">Position</h4>
            </div>
          </div>
          <div class="card">
            <div class="card-content">
              <div class="card-body">
                <div class="row mt-1">
                  <div class="col-md-6 col-sm-12">
                    <h5>Top Positions</h5>
                    <button type="button" class="btn btn-lg btn-block btn-outline-primary mb-2" id="position-top-left">Top Left</button>
                    <button type="button" class="btn btn-lg btn-block btn-outline-primary mb-2" id="position-top-center">Top Center</button>
                    <button type="button" class="btn btn-lg btn-block btn-outline-primary mb-2" id="position-top-right">Top Right</button>
                    <button type="button" class="btn btn-lg btn-block btn-outline-primary mb-2" id="position-top-full">Top Full Width</button>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <h5>Bottom Positions</h5>
                    <button type="button" class="btn btn-lg btn-block btn-outline-primary mb-2" id="position-bottom-left">Bottom Left</button>
                    <button type="button" class="btn btn-lg btn-block btn-outline-primary mb-2" id="position-bottom-center">Bottom Center</button>
                    <button type="button" class="btn btn-lg btn-block btn-outline-primary mb-2" id="position-bottom-right">Bottom Right</button>
                    <button type="button" class="btn btn-lg btn-block btn-outline-primary mb-2" id="position-bottom-full">Bottom Full Width</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- // Position section end -->
        <!-- Options section start -->
        <section id="options">
          <div class="row">
            <div class="col-12 mt-3 mb-1">
              <h4 class="text-uppercase">Options</h4>
            </div>
          </div>
          <div class="card">
            <div class="card-content">
              <div class="card-body">
                <div class="row mt-1">
                  <div class="col-md-3 col-sm-12">
                    <h5>Text Notifications</h5>
                    <p>This notification just includes text.</p>
                    <button type="button" class="btn btn-lg btn-block btn-outline-primary mb-2" id="text-notification">Show Toast</button>
                  </div>
                  <div class="col-md-3 col-sm-12">
                    <h5>Close Button</h5>
                    <p>Close this notification clicking on close button.</p>
                    <button type="button" class="btn btn-lg btn-block btn-outline-primary mb-2" id="close-button">Show Toast</button>
                  </div>
                  <div class="col-md-3 col-sm-12">
                    <h5>Progress Bar</h5>
                    <p>Visually indicate how long before a toast expires.</p>
                    <button type="button" class="btn btn-lg btn-block btn-outline-primary mb-2" id="progress-bar">Show Toast</button>
                  </div>
                  <div class="col-md-3 col-sm-12">
                    <h5>Clear Toast</h5>
                    <p>Add button to force clearing a toast, ignoring focus.</p>
                    <button type="button" class="btn btn-lg btn-block btn-outline-primary mb-2" id="clear-toast-btn">Show Toast</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- // Options section end -->
        <!-- Clear toasts section start -->
        <section id="clear-toasts">
          <div class="row">
            <div class="col-12 mt-3 mb-1">
              <h4 class="text-uppercase">Clear Toasts</h4>
            </div>
          </div>
          <div class="card">
            <div class="card-content">
              <div class="card-body">
                <div class="row mt-1">
                  <div class="col-md-6 col-sm-12">
                    <h5>Remove</h5>
                    <p>Immediately remove current toasts without using animation.</p>
                    <button type="button" class="btn btn-lg btn-block btn-outline-primary mb-2" id="show-remove-toast">Show Toast</button>
                    <button type="button" class="btn btn-lg btn-block btn-outline-primary mb-2" id="remove-toast">Remove Toast</button>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <h5>Clear</h5>
                    <p>Remove current toasts using animation.</p>
                    <button type="button" class="btn btn-lg btn-block btn-outline-primary mb-2" id="show-clear-toast">Show Toast</button>
                    <button type="button" class="btn btn-lg btn-block btn-outline-primary mb-2" id="clear-toast">Clear Toast</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- // Clear toasts section end -->
        <!-- Duration & Timeout section start -->
        <section id="duration-timeout">
          <div class="row">
            <div class="col-12 mt-3 mb-1">
              <h4 class="text-uppercase">Duration & Timeout</h4>
            </div>
          </div>
          <div class="card">
            <div class="card-content">
              <div class="card-body">
                <div class="row mt-1">
                  <div class="col-md-6 col-sm-12">
                    <h5>Show .5s</h5>
                    <p>You can define via <code>showDuration</code> what amount of time
                      will it take to show a message.</p>
                    <button type="button" class="btn btn-lg btn-block btn-outline-primary mb-2" id="fast-duration">Show Toast</button>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <h5>Hide 3s</h5>
                    <p>You can define via <code>hideDuration</code> what amount of time
                      will it take to hide a message.</p>
                    <button type="button" class="btn btn-lg btn-block btn-outline-primary mb-2" id="slow-duration">Show Toast</button>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 col-sm-12">
                    <h5>Timeout 5s</h5>
                    <p>You can define via <code>timeout</code> for what amount of time
                      in milliseconds a message is visible.</p>
                    <button type="button" class="btn btn-lg btn-block btn-outline-primary mb-2" id="timeout">Show Toast</button>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <h5>Sticky</h5>
                    <p>You can also create a sticky message by setting the <code>timeout</code>                      to <code>0</code>.</p>
                    <button type="button" class="btn btn-lg btn-block btn-outline-primary mb-2" id="sticky">Show Toast</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- // Duration & Timeout section end -->
        <!-- Animation section start -->
        <section id="animation">
          <div class="row">
            <div class="col-12 mt-3 mb-1">
              <h4 class="text-uppercase">Show / Hide Animation</h4>
              <p>Use the jQuery <code>show/hide</code> method of your choice. These
                default to <code>fadeIn/fadeOut</code>. The methods <code>fadeIn/fadeOut</code>,
                <code>slideDown/slideUp</code>, and <code>show/hide</code> are built
                into jQuery.</p>
            </div>
          </div>
          <div class="card">
            <div class="card-content">
              <div class="card-body">
                <div class="row mt-1">
                  <div class="col-md-6 col-sm-12">
                    <button type="button" class="btn btn-lg btn-block btn-outline-primary mb-2" id="slide-toast">slideDown - slideUp</button>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <button type="button" class="btn btn-lg btn-block btn-outline-primary mb-2" id="fade-toast">fadeIn - fadeOut</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- // Animation section end -->
      </div>
    </div>
  </div>

  <?php include 'footer.php'; ?>