async function callbackSendData(event) {
  const csrf_token = document.querySelector("input[name=_token]").value;
  const request = {
    user_id: event.currentTarget.dataset.user,
    product_id: event.currentTarget.dataset.product,
  };

  try {
    const response = await fetch("/api/temp-faktur-list", {
      method: "POST",
      credentials: "same-origin",
      headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
        url: "/api/temp-faktur-list",
        "X-CSRF-TOKEN": csrf_token,
      },
      cache: "no-cache",
      body: JSON.stringify(request),
    });

    const result = await response.json();

    const Toast = Swal.mixin({
      toast: true,
      position: "top-end",
      showConfirmButton: false,
      timer: 1500,
    });

    if (result.status == "ok") {
      Toast.fire({
        icon: "success",
        title: result.message,
      });
    } else {
      Toast.fire({
        icon: "error",
        title: result.message,
      });
    }
  } catch (error) {
    console.log(error);
  }
}

faktur_btn = document.querySelectorAll(".faktur-btn");

faktur_btn.forEach((element) => {
  element.addEventListener("click", callbackSendData);
});
