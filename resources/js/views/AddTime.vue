<template>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title text-uppercase">Availability Table</h4>
              <p class="card-category">Here is a list of your Availability</p>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <!-- Button trigger modal -->

                <button
                  type="button"
                  data-toggle="modal"
                  data-target="#bookModal"
                  class="btn btn-primary"
                >
                  <span class="material-icons">add_circle</span>
                </button>
                <table class="table">
                  <thead class="text-primary">
                    <th>ID</th>
                    <th>Name</th>
                    <th>State</th>
                    <th>City</th>
                    <th>Doctor</th>
                    <th>Booked_at</th>
                    <th>Actions</th>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>Dakota Rice</td>
                      <td>Niger</td>
                      <td>Oud-Turnhout</td>
                      <td class="text-primary">$36,738</td>
                      <td class="text-primary">$36,738</td>
                      <td class="text-primary">
                        <button type="button" class="btn btn-danger">
                          <span class="material-icons">remove_circle</span>
                        </button>
                        <button type="button" class="btn btn-info">
                          <span class="material-icons">create</span>
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div
      class="modal fade"
      id="bookModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header"></div>
          <div class="modal-body">
            <div class="card card-nav-tabs">
              <div class="card-header card-header-primary">Book Appointment</div>
              <div class="card-body">
                <form>
                  <div class="form-group">
                    <label for="email" class="text-primary">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" />
                  </div>
                  <div class="form-group">
                    <label for="doctor" class="text-primary">Select Doctor</label>
                    <select
                      name="doctor"
                      class="form-control selectpicker"
                      data-style="btn btn-link"
                      id="doctor"
                    >
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="date" class="text-primary">Date</label>
                    <input type="Date" class="form-control" id="date" name="date" />
                  </div>

                  <div class="form-group">
                    <label for="time" class="text-primary">Time</label>
                    <input type="time" class="form-control" id="time" name="time" />
                  </div>

                  <div class="form-group">
                    <label for="purpose" class="text-primary">Reason for Appointment</label>
                    <textarea class="form-control" id="purpose" rows="3"></textarea>
                  </div>
                  <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block">BOOK</button>
                </form>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Clear</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>