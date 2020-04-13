<template>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title text-uppercase">Doctors Table</h4>
              <p class="card-category">Here is a list of your doctor</p>
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
                    <th>FirstName</th>
                    <th>LastName</th>
                    <th>Email</th>
                    <th>State</th>
                    <th>Specailizastion</th>
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
              <div class="card-header card-header-primary text-uppercase">Add Doctor</div>
              <div class="card-body">
                <form>
                  <div class="form-group">
                    <label for="firstname" class="text-primary">FirstName</label>
                    <input type="text" class="form-control" id="firstname" name="FirstName" />
                  </div>
                  <div class="form-group">
                    <label for="lastname" class="text-primary">LastName</label>
                    <input type="text" class="form-control" id="lastname" name="LastName" />
                  </div>
                  <div class="form-group">
                    <label for="email" class="text-primary">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" />
                  </div>
                  <div class="form-group">
                    <label for="state" class="text-primary">State</label>
                    <select
                      name="state"
                      class="form-control selectpicker"
                      data-style="btn btn-link"
                      id="state"
                    >
                      <option>1</option>
                      <option>2</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="specialization" class="text-primary">Specailizastion</label>
                    <input
                      type="Text"
                      class="form-control"
                      id="specialization"
                      name="specialization"
                    />
                  </div>
                  <button
                    type="submit"
                    name="submit"
                    class="btn btn-primary btn-lg btn-block"
                  >ADD DOCTOR</button>
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