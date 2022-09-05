input_file = document.querySelector("#inputPicture");
label = document.querySelector(".custom-file-label");

input_file.addEventListener("change", (e) => {
  label.textContent = e.target.files.item(0).name;
});

// Create Data table
$("#example1").DataTable({
  paging: true,
  ordering: false,
  info: true,
  autoWidth: false,
  responsive: true,
});

function selectOptionIndex(select_el, val) {
  for (let i, j = 0; (i = select_el.options[j]); j++)
    if (i.value == val) return (select_el.selectedIndex = j);
  return null;
}

// Fetch data to populate update modal data
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
  const select = document.getElementById("inputCategory");
  selectOptionIndex(select, result.category);

  console.log(result);
  document.getElementById("inputId").value = result.id;
  document.getElementById("modal-thumbnail").src = image_path;
  document.getElementById("inputName").value = result.name;
  document.getElementById("inputPrice").value = result.price;
  document.getElementById("inputQuantity").value = result.quantity;
}

function deleteProducts(event) {
  event.preventDefault();
  const id = event.currentTarget.dataset.product;
  document.querySelector(".delete-products-" + id).submit();
}
