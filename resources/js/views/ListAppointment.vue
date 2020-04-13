<template>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title text-uppercase">Appointment Table</h4>
              <p class="card-category">Here is a list of your table</p>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <!-- Button trigger modal -->
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
  </div>
</template>