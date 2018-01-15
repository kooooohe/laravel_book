<template>
  <div id="app">
    <el-container style="height: 1000px; border: 1px solid #eee">
        <el-aside width="200px" style="background-color: rgb(238, 241, 246)">

         <el-menu :default-openeds="['1', '1']">
          <el-submenu index="1">
            <template slot="title"><i class="el-icon-star-off"></i>Menu</template>
              <el-menu-item index="1-1">
                <router-link :to="{ name: 'books'}">Books List</router-link>
              </el-menu-item>
              <el-menu-item index="1-2">
                <router-link :to="{ name: 'addBook'}">Add Book</router-link>
              </el-menu-item>
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
