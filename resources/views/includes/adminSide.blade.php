     @can('isAdmin')
    <li class="nav-item ">
            <router-link class="nav-link" to="/doctor_available">
              <i class="material-icons">person</i>
              <p>Doctor Available</p>
            </router-link>
          </li>
          @endCan
           @can('isAdmin')
          <li class="nav-item ">
            <router-link class="nav-link" to="/add_doctor">
              <i class="material-icons">content_paste</i>
              <p>Manage Doctor</p>
            </router-link>
          </li>
            @endCan
          <li class="nav-item ">
            <router-link class="nav-link" to="/doctor_calender">
              <i class="material-icons">library_books</i>
              <p>Calender</p>
            </router-link>
          </li>
          @can('isAdmin')
          <li class="nav-item ">
            <router-link class="nav-link" to="/complain_list">
              <i class="material-icons">bubble_chart</i>
              <p>Complain</p>
            </router-link>
          </li>
            @endCan
          <li class="nav-item ">
            <router-link class="nav-link" to="/map">
              <i class="material-icons">location_ons</i>
              <p>Maps</p>
            </router-link>
          </li>
          <li class="nav-item ">
            <router-link class="nav-link" to="/add_time">
              <i class="material-icons">library_books</i>
              <p>Add Time</p>
            </router-link>
          </li>
          <li class="nav-item ">
            <router-link class="nav-link" to="/list_appointment">
              <i class="material-icons">library_books</i>
              <p>All Appoiment</p>
            </router-link>
          </li>
        </ul>
      </div>
    </div>
