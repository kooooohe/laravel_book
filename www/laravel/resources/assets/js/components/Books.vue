<template>
<div>
<el-autocomplete
  v-model="search_word"
  @keyup.enter="testSubmit"
  :fetch-suggestions="querySearchAsync"
  placeholder="Please input"
  @select="handleSelect"
></el-autocomplete>
<el-button type="primary" icon="el-icon-search" :loading="is_loading" @click="fetchBooks">Search</el-button>

<hr>

  <el-table
    :data="books"
    height="500"
    style="width: 100%">
    <el-table-column
      prop="name"
      label="Name"
      width="180">
    </el-table-column>
      <el-table-column
      width="180"
      label="Operations">
      <template slot-scope="scope">
        <el-button
          v-if="user_id === scope.row['user_id']"
          size="warning"
          @click="returnBook(scope.$index, scope.row)" plain>Return</el-button>
        <el-button
          v-else
          size="success"
          @click="lendBook(scope.$index, scope.row)" plain v-bind:disabled="scope.row['is_lend'] == 1">Lend</el-button>
      </template>
    </el-table-column>
    <el-table-column
      prop="lend_date"
      label="LendDate"
      width="180">
    </el-table-column>
    <el-table-column
      prop="user_name"
      label="LendUser"
      width="180">
    </el-table-column>
  </el-table>
</div>
</template>

<script>
  import http from '../services/http'

  export default {
    mounted() {
      //run when load this page
      this.fetchAllBooks();
    },
    data() {
      return {
        books: [],
        books_backup: [],
        author: '',
        created_at: '',
        is_loading:false,

        sujests: [],
        search_word: '',
        timeout:  null,
        user_id: parseInt(document.getElementById('user_id').value),
      }
    },
    methods: {
      fetchBooks () {
        console.log(this.search_word);
        this.is_loading = true;
        http.post('books', {name: this.search_word}, res => {
          this.books = res.data;
          this.is_loading = false;
        });
      },

      fetchAllBooks () {
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
      //既存のデータから選択した情報だけ出す
      handleSelect(item) {
        console.log(item.id);
        this.books = this.books_backup.filter(function(element, index, array) {
           return (element.name == item.value);
        });
      },

      lendBook(index, row) {
        console.log(row["id"]);
        const book_id = row['id'];
        row['is_lend'] = true;
        http.get('book/lend/' + book_id, res => {
          console.log(res.data);
        });
         this.$notify.success({
          title: 'Info',
          message: 'You lend ' + row['name'],
          showClose: false
        });
      },
      returnBook(index, row) {
        console.log(row["id"]);
        const book_id = row['id'];
        http.get('book/return/' + book_id, res => {
          console.log(res.data);
        });
         this.$notify.success({
          title: 'Info',
          message: 'You return ' + row['name'],
          showClose: false
        });
      },
    }
  }
</script>
