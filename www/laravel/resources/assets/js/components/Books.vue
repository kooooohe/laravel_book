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
    v-loading="loading2"
    element-loading-text="Loading..."
    element-loading-background="rgba(0, 0, 0, 0.8)"

    :data="books"
    height="500"
    style="width: 100%">
    <el-table-column
      prop="name"
      sortable
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
          @click="borrowBook(scope.$index, scope.row)" plain v-bind:disabled="scope.row['is_lend'] == 1">Borrow</el-button>
      </template>
    </el-table-column>
    <el-table-column
      prop="lend_date"
      sortable
      label="LendDate"
      width="180">
    </el-table-column>
    <el-table-column
      prop="user_name"
      label="BorrowUser"
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

        loading2: true,

      }
    },
    methods: {
      fetchBooks () {
        console.log(this.search_word);
        this.is_loading = true;
        this.loading2 = true;
        http.post('books', {name: this.search_word}, res => {
          this.books = res.data;
          this.is_loading = false;
          this.loading2 = false;

        });
      },

      fetchAllBooks () {
        this.loading2 = true;

        http.get('books', res => {
          this.books = res.data;
          this.books_backup = res.data;

          let names = [];
          for (let i in res.data){
            names.push({"value": res.data[i].name, "id": res.data[i].id});
          }
          this.sujests = names;
          this.loading2 = false;
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
        let sujests = this.sujests;
        let results = queryString ? sujests.filter(this.createFilter(queryString)) : sujests;

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

      borrowBook(index, row) {
        console.log(row["id"]);
        const book_id = row['id'];
        row['is_lend'] = true;
        http.get('book/borrow/' + book_id, res => {
          console.log(res.data);
        });
         this.$notify.success({
          title: 'Info',
          message: 'You borrow ' + row['name'],
          showClose: false
        });
      },
      returnBook(index, row) {
        console.log(row["id"]);
        const book_id = row['id'];
        row['user_id'] = null;
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
