import axios from "axios";
import Cookies from "js-cookie";

axios.defaults.baseURL = "http://localhost:8000";

// Storing the cookie
axios.interceptors.request.use(
  function (config) {
    // Get the token from the cookie
    const token = Cookies.get("access_token");

    // If token exists, add it to the request headers
    if (token) {
      config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
  },
  function (error) {
    // Do something with request error
    return Promise.reject(error);
  }
);

export default axios;

// Login
export async function login(email, password) {
  const data = {
    email: email,
    password: password,
  };

  const response = await axios.post("api/login", data);

  if (response.data["success"] === "true") {
    const token = response.data["access_token"];

    // Storing the token on local
    Cookies.set("access_token", token);
    return true;
  } else {
    return false;
  }
}

// Logout
export async function logout() {
  try {
    // Make a request to the logout endpoint
    const response = await axios.post("/logout");

    // Clear the access token cookie upon successful logout
    Cookies.remove("access_token");

    return response.data;
  } catch (error) {
    throw error;
  }
}

// Register
export async function register(name, email, password, passwordConfirmation) {
  if (password === passwordConfirmation) {
    const data = {
      name: name,
      email: email,
      password: password,
      password_confirmation: passwordConfirmation,
    };

    const response = await axios.post("/api/register", data);

    return response;
  } else {
    return null;
  }
}

// ==============================================================================
// Usesr consumption
// ==============================================================================
// Register
export async function indexUsersRanged(page, perPage, filter) {
  const response = await axios.get(`/api/users/indexRanged/${page}/${perPage}/${filter}`);
  //console.log('filter: ' + filter + " : " , response);
  return response;
}
// Fetch user info
export async function whoami() {
  const response = await axios.get("/api/user");
  return response;
}

// Add user

export async function addUser(name, email, password, profilepic){
  const data = {
    name:name,
    email:email,
    password:password,
    profilepic:profilepic,
  }
  const response = await axios.get("/api/users/index", data);
  return response;
}

// Delete user
export async function deleteUser(id){
  const response = await axios.delete(`/api/users/delete/${id}`);
  return response;
}

// ==============================================================================
// Products consumption
// ==============================================================================

// index
// Register
export async function productIndexRanged(perPage, page) {
    const response = await axios.get(`/api/products/indexRanged/${page}/${perPage}`);
    return response;
}

export async function productIndexFiltered(perPage, page, filter, search) {
  
  const response = await axios.get(`/api/products/indexRangedFiltered/${page}/${perPage}?filter=${filter}&search=${search}`);
  return response;
}

// Add
export async function productAdd(name,sku,description,price,photos) {
  const data = {
    name:name,
    sku:sku,
    description:description,
    price:price,
    photos:photos,
  };
  const response = await axios.post("/api/products/add", data);
  console.log(response);
  return response;
}

// Get
export async function productGet(id) {
  const data = {
    id:id,
  };

  const response = await axios.post("/api/products/get", data);
  return response;
}

// Delete
export async function deleteProduct(id) {
  const data = {
    id:id,
  };
  const response = await axios.delete(`/api/products/delete/${id}`, data);
  return response;
}

// Patch
export async function productUpdate(id,name,sku,description,price,photos) {
  const data = {
    name:name,
    sku:sku,
    description:description,
    price:price,
    photos:photos,
  };

  const response = await axios.patch(`/api/products/update/${id}`, data);
  return response;
}