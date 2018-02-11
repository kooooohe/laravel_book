<template>
  <div id="app">
    <el-container style="height: 100%; border: 1px solid #eee">
        <el-aside width="200px" style="background-color: rgb(238, 241, 246)">

         <el-menu :default-openeds="['1', '1']">
          <el-submenu index="1">
            <template slot="title"><i class="el-icon-star-off"></i>Book</template>
              <router-link :to="{ name: 'books'}">
                <el-menu-item index="1-1">
                  Book List
                </el-menu-item>
              </router-link>
              <router-link :to="{ name: 'addBook'}">
                <el-menu-item index="1-2">
                  Add Book
                </el-menu-item>
              </router-link>
          </el-submenu>
          <el-submenu index="2">
            <template slot="title"><i class="el-icon-tickets"></i>Job</template>
                <el-menu-item index="2-1">
                  Job List
                </el-menu-item>
              <router-link :to="{ name: 'addJob'}">
                <el-menu-item index="20">
                  Add Job
                </el-menu-item>
              </router-link>
          </el-submenu>

         </el-menu>

        </el-aside>
        <el-main>
            <div>
              <router-view></router-view>
            </div>
        </el-main>
    </el-container>
  </div>
</template>
