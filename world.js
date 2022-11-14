function getAllCountries() {
  return fetch("http://localhost/info2180-lab5/world.php")
    .then((result) => result.text())
    .then((data) => data)
    .catch((err) => err);
}
function sanitizeInput(str) {
  str = str.replace(/[^a-z0-9áéíóúñü \.,_-]/gim, " ");
  return str.trim();
}
function getSpecificCountry(country) {
  return fetch(`http://localhost/info2180-lab5/world.php?country=${country}`)
    .then((result) => result.text())
    .then((data) => data)
    .catch((err) => err);
}

function searchCountries(search) {
  let newSearch = sanitizeInput(search);
  if (search === null || newSearch === "") return getAllCountries();
  return getSpecificCountry(newSearch);
}

document.getElementById("lookup").addEventListener("click", () => {
  searchCountries(document.getElementById("country").value).then(
    (data) => (document.getElementById("result").innerHTML = data)
  );
});
