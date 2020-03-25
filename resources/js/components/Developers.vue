<template>
  <div>
    <h2>Developers</h2>
    <form @submit.prevent="addDeveloper" class="mb-3">
      <div class="form-group row">
        <div class="col-md-5">
          <input
            type="text"
            class="form-control"
            placeholder="First Name"
            v-model="developer.first_name"
          />
        </div>
        <div class="col-md-5">
          <input
            type="text"
            class="form-control"
            placeholder="Last Name"
            v-model="developer.last_name"
          />
        </div>
      </div>
      <div class="form-group row">
        <div class="col-md-5">
          <input type="text" class="form-control" placeholder="Email" v-model="developer.email" />
        </div>
        <div class="col-md-5">
          <input type="text" class="form-control" placeholder="Phone" v-model="developer.phone" />
        </div>
      </div>
      <div class="form-group row">
        <div class="col-md-5">
          <input
            type="text"
            class="form-control"
            placeholder="Position"
            v-model="developer.position"
          />
        </div>
        <div class="col-md-5">
          <input type="text" class="form-control" placeholder="Role" v-model="developer.role" />
        </div>
      </div>
      <button type="submit" class="btn btn-success">Save</button>
    </form>

    <ul class="pagination">
      <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
        <a class="page-link" href="#" @click="fetchDevelopers(pagination.prev_page_url)">Previous</a>
      </li>

      <li class="page-item disabled">
        <a
          class="page-link text-dark"
          href="#"
        >Page {{ pagination.current_page }} of {{ pagination.last_page }}</a>
      </li>

      <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
        <a class="page-link" href="#" @click="fetchDevelopers(pagination.next_page_url)">Next</a>
      </li>
    </ul>

    <div class="card card-body mb-2" v-for="developer in developers" v-bind:key="developer.id">
      <h3>{{developer.first_name}} {{developer.last_name}}</h3>
      <p>Email: {{developer.email}}</p>
      <p>Phone: {{developer.phone}}</p>
      <p>Position: {{developer.position}}</p>
      <p>Role: {{developer.role}}</p>
      <button @click="editDeveloper(developer)" class="btn btn-warning mb-2">Edit</button>
      <button @click="deleteDeveloper(developer.id)" class="btn btn-danger">Delete</button>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      developers: [],
      developer: {
        id: "",
        first_name: "",
        last_name: "",
        email: "",
        phone: "",
        position: "",
        role: ""
      },
      developer_id: "",
      pagination: {},
      edit: false
    };
  },

  created() {
    this.fetchDevelopers();
  },

  methods: {
    fetchDevelopers(page_url) {
      let vm = this;
      page_url = page_url || "api/developers";
      fetch(page_url)
        .then(res => res.json())
        .then(res => {
          this.developers = res.data;
          vm.makePagination(res.meta, res.links);
        })
        .catch(err => console.log(err));
    },
    makePagination(meta, links) {
      let pagination = {
        current_page: meta.current_page,
        last_page: meta.last_page,
        next_page_url: links.next,
        prev_page_url: links.prev
      };
      this.pagination = pagination;
    },
    addDeveloper() {
      if (this.edit === false) {
        // Add
        fetch("api/developer", {
          method: "post",
          body: JSON.stringify(this.developer),
          headers: {
            "content-type": "application/json"
          }
        })
          .then(res => res.json())
          .then(data => {
            this.clearForm();
            alert("New Developer record added successfully");
            this.fetchDevelopers();
          })
          .catch(err => console.log(err));
      } else {
        // Update
        console.log("here");
        fetch("api/developer", {
          method: "put",
          body: JSON.stringify(this.developer),
          headers: {
            "content-type": "application/json"
          }
        })
          .then(res => res.json())
          .then(data => {
            this.clearForm();
            alert("Developer record updated successfully");
            this.fetchDevelopers();
          })
          .catch(err => console.log(err));
      }
    },
    editDeveloper(developer) {
      this.edit = true;
      this.developer.id = developer.id;
      this.developer.developer_id = developer.id;
      this.developer.first_name = developer.first_name;
      this.developer.last_name = developer.last_name;
      this.developer.email = developer.email;
      this.developer.phone = developer.phone;
      this.developer.position = developer.position;
      this.developer.role = developer.role;
    },
    deleteDeveloper(id) {
      if (confirm("Are You Sure?")) {
        fetch(`api/developer/${id}`, {
          method: "delete"
        })
          .then(res => res.json())
          .then(data => {
            alert("Developer record removed successfully");
            this.fetchDevelopers();
          })
          .catch(err => console.log(err));
      }
    },
    clearForm() {
      this.edit = false;
      this.developer.id = null;
      this.developer.developer_id = null;
      this.developer.first_name = "";
      this.developer.last_name = "";
      this.developer.email = "";
      this.developer.phone = "";
      this.developer.position = "";
      this.developer.role = "";
    }
  }
};
</script>