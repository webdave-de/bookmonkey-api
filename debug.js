async function getBooks(id) {
  const response = await fetch(`http://localhost/bookmonkey-api/books/${id}`);
  const json = await response.json();

  return json;
}
