<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
	<title></title>
</head>
<body>
<div class="container">
  <div class="row mx-0 justify-content-center">
    <div class="col-md-7 col-lg-5 px-lg-2 col-xl-4 px-xl-0 px-xxl-3">
      <form
        method="POST"
        class="w-100 rounded-1 p-4 border bg-white"
        action="https://herotofu.com/start"
      >
        <label class="d-block mb-4">
          <label class="d-block mb-4">
            <span class="form-label d-block">Email address</span>
            <input
              name="email"
              type="email"
              class="form-control"
              placeholder="joe.bloggs@example.com"
              required
            />
          </label>

          <span class="form-label d-block">Phone number</span>
          <input
            name="phone"
            type="text"
            class="form-control"
            placeholder="1-(000)-000-0000"
            required
          />
        </label>

        <label class="d-block mb-4">
          <span class="form-label d-block">Message</span>
          <textarea
            name="message"
            class="form-control"
            rows="3"
            placeholder="Any details?"
          ></textarea>
        </label>

        <div class="mb-3">
          <button type="submit" class="btn btn-primary px-3 rounded-3">
            Get Offer
          </button>
        </div>

        <div class="d-block text-end">
          <div class="small">
            by
            <a
              href="https://herotofu.com"
              class="text-dark text-decoration-none"
              target="_blank"
              >HeroTofu</a
            >
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
</body>
</html>