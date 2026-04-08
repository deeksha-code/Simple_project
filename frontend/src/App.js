import React, { useEffect, useState } from "react";

// const URL = "http://localhost/simple-project/api.php";
const URL = "http://localhost/Simple_project/api1.php";

function App() {
  const [users, setUsers] = useState([]);
  const [name, setName] = useState("");
  const [email, setEmail] = useState("");

const loadUsers = async () => {
  const res = await fetch(URL);
  // const data = await res.json();
  const text = await res.text();   //  read raw response

  console.log("API RESPONSE:", text);

  const data = JSON.parse(text);
  setUsers(data);
};

  useEffect(() => {
    loadUsers();
  }, []);

  const addUser = async () => {
    await fetch(URL, {
      method: "POST",
      body: JSON.stringify({ name, email }),
    });
    loadUsers();
  };

  const deleteUser = async (id) => {
    await fetch(`${URL}?id=${id}`, {
      method: "DELETE",
    });
    loadUsers();
  };

  return (
    <div>
      <h2>Simple CRUD</h2>

      <input placeholder="Name" onChange={(e) => setName(e.target.value)} />
      <input placeholder="Email" onChange={(e) => setEmail(e.target.value)} />
      <button onClick={addUser}>Add</button>

      {users.map((u) => (
        <div key={u.id}>
          {u.name} - {u.email}
          <button onClick={() => deleteUser(u.id)}>Delete</button>
        </div>
      ))}
    </div>
  );
}

export default App;