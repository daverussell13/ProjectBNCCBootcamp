async function fetchDataProduct(event) {
  const csrf_token = document.querySelector("input[name=_token]").value;

  const request_data = {
    id: event.currentTarget.dataset.product,
  };

  const response = await fetch("/api/getproduct", {
    method: "POST",
    credentials: "same-origin",
    headers: {
      "Content-Type": "application/json",
      Accept: "application/json",
      url: "/api/getproduct",
      "X-CSRF-TOKEN": csrf_token,
    },
    cache: "no-cache",
    body: JSON.stringify(request_data),
  });

  const result = await response.json();
  const image_path = window.location.origin + "/storage/" + result.picture;
  const option = document.querySelector(
    "option[value='" + result.category + "']"
  );

  option.setAttribute("selected", "");
  document.getElementById("modal-thumbnail").src = image_path;
  document.getElementById("inputName").value = result.name;
  document.getElementById("inputPrice").value = result.price;
  document.getElementById("inputQuantity").value = result.quantity;
}
