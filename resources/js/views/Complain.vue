<template>
  <div class="container">
    <div class="card card-nav-tabs">
      <div class="card-header card-header-primary text-uppercase">Complain Form</div>
      <div class="card-body">
        <form>
          <div class="form-group">
            <label for="subject" class="text-primary">Subject</label>
            <input
              type="email"
              class="form-control"
              id="subject"
              name="subject"
              aria-describedby="emailHelp"
              placeholder="Enter email"
            />
          </div>

          <div class="form-group">
            <label for="purpose" class="text-primary">Complain</label>
            <textarea name="subject" class="form-control" id="purpose" rows="3"></textarea>
          </div>

          <button type="submit" name="submit" class="btn btn-primary btn-lg">Send</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    console.log("Component mounted.");
  }
};
</script>
