<template>
<div>
<el-autocomplete
  v-model="state4"
  @keyup.enter="testSubmit"
  :fetch-suggestions="querySearchAsync"
  placeholder="Please input"
  @select="handleSelect"
></el-autocomplete>
<hr>

  <el-table
    :data="books"
    height="500"
    style="width: 100%">
    <el-table-column
      prop="date"
      label="Date"
      width="180">
    </el-table-column>
    <el-table-column
      prop="name"
      label="Name"
      width="180">
    </el-table-column>
      <el-table-column
      label="Operations">
      <template slot-scope="scope">
        <el-button
          size="mini"
          @click="handleEdit(scope.$index, scope.row)">Edit</el-button>
        <el-button
          size="mini"
          type="danger"
          @click="handleDelete(scope.$index, scope.row)">Delete</el-button>
      </template>
    </el-table-column>
  </el-table>
  </div>
</template>

<script>
  import http from '../services/http'

  export default {
    mounted() {
      this.fetchBooks();
      //this.loadAll();
    },
    data() {
      return {
        books: [],
        books_backup: [],
        author: '',
        created_at: '',

        sujests: [],
        state4: '',
        timeout:  null
      }
    },
    methods: {
    testSubmit () {
     console.log("aaa");
    },

      fetchBooks () {
        // TODO: not to send request when the user is not authenticated
        http.get('books', res => {
          this.books = res.data;
          this.books_backup = res.data;

          let names = [];
          for (let i in res.data){
            names.push({"value": res.data[i].name, "id": res.data[i].id});
          }
          this.sujests = names;
        console.log(names);
        })
      },
      //addTask () {
      //  if (this.name === '') {
      //    this.showAlert = true
      //    this.alertMessage = 'Task name should not be blank.'
      //    return false
      //  }
      //  http.post('tasks', {name: this.name}, res => {
      //    this.tasks[res.data.id] = res.data
      //    this.name = ''
      //    this.showAlert = false
      //    this.alertMessage = ''
      //  })
      //},
      //completeTask (task) {
      //  http.put('tasks/' + task.id, {is_done: !task.is_done}, res => {
      //    this.tasks[task.id] = res.data
      //    this.$forceUpdate()
      //  })
      //},
      //removeTask (task) {
      //  http.delete('tasks/' + task.id, {}, () => {
      //    delete this.tasks[task.id]
      //    this.$forceUpdate()
      //  })
      //},
      //loadAll() {
      //    this.sujests =
      //  [
      //    { "value": "vue"        },
      //    { "value": "element"    },
      //    { "value": "cooking"    },
      //    { "value": "mint-ui"    },
      //    { "value": "vuex"       },
      //    { "value": "vue-router" },
      //    { "value": "babel"      }
      //   ];
      //},
      querySearchAsync(queryString, cb) {
        var sujests = this.sujests;
        var results = queryString ? sujests.filter(this.createFilter(queryString)) : sujests;

        clearTimeout(this.timeout);
        this.timeout = setTimeout(() => {
          cb(results);
        }, 3000 * Math.random());
      },
      createFilter(queryString) {
        return (link) => {
          return (link.value.toLowerCase().indexOf(queryString.toLowerCase()) === 0);
        };
      },
      handleSelect(item) {
        console.log(item.id);
        this.books = this.books_backup.filter(function(element, index, array) {
            console.log(element.name);
            console.log(item.value);
               return (element.name == item.value);
        });

        //this.books = [this.books[item.id - 1]];
      }
    }
  }
</script>
