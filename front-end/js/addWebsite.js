$(document).ready(function() {
  setActivePage("add-new-website");
});

// Bind to the submit event of our form
$("#btn-submit").click(function(event) {
  // Prevent default posting of form - put here to work in case of errors
  event.preventDefault();

  var siteName = $("#site_name").val();
  var siteURL = $("#site_url").val();
  var siteImagePath = $("#site_img_path").val();
  var valid = true;

  if (siteName === "" || siteURL === "") {
    Swal.fire("Required Field Left Blank", "You had one job...", "error", {
      timer: 3000
    });
    valid = false;
  }

  if (valid === false) {
  } else {
    d_saveNewWebsite(siteName, siteURL, siteImagePath).then(
      website => {
        const Toast = Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 3000
        });

        Toast.fire({
          type: "success",
          title: siteName + " added successfully"
        }).then(function() {
          window.location.href = "index.php";
        });
      },
      () => {}
    );
  }
});
