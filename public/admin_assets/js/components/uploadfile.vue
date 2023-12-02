
<template>
  <div class="container py-2">
    <div class="large-12 medium-12 small-12 cell">

      <div class=" w-full ">
        <div class="col-span-4"></div>
        <svg v-if="files.length > 0" @click="isActivemodal = false" xmlns="http://www.w3.org/2000/svg"
          class="h-6 w-6 mx-auto col-span-2 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
        </svg>
        <svg v-else @click="isActivemodal = false" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto col-span-2"
          fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
        </svg>
        <!-- <span v-if="files.length > 0"  class="col-span-3 mx-auto  px-2 py-1 text-xs font-bold leading-none text-red-100 
                                 bg-red-600 rounded-full"> ({{files.length}} )</span> -->
      </div>


    </div>

    <div v-cloak v-if="isActivemodal == false" style="z-index: 200"
      class="min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 flex justify-center items-center inset-0 outline-none focus:outline-none bg-no-repeat bg-center bg-cover">
      <div @click="closemodal()" class="absolute bg-black opacity-80 inset-0 z-0"></div>
      <div style="height:80vh"
        class="w-6/12   relative mx-auto my-auto rounded-xl shadow-lg  bg-white overflow-y-auto h-screen ">
        <!--content-->
        <button class="text-4xl ml-2" @click="closemodal()">x </button>
        <div class=" text-center text-4xl text-red-500">
          ĐÍNH KÈM
        </div>

        <!--body-->
        <div class="p-2 mt-2">
          <div class="mt-1  border-2 border-gray-300 border-dashed rounded-md">
            <div class="space-y-1 text-center pt-4">
              <div class=" grid grid-cols-12 ">
                <div v-for="(file, key) in files" class="col-span-3  p-4">
                  <div>
                    <!--  <button  v-on:click="openModal()">
                                {{ file.tenfile }}
                                </button>-->
                    <div class=" relative w-full  -mt-4 mx-auto">
                      <div class="h-20 w-10 "
                        :style="`background-image: url('` + file.linkbackground + `');;width:100%;height:200px;background-size: cover;background-position: center;`">
                        <svg style="cursor: pointer;" v-on:click="removeFile(key, file)" class="mx-auto my-auto h-full"
                          width="54px" height="54px" viewBox="0 0 54 54" version="1.1"
                          xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                          <title>Error</title>
                          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g stroke="#747474" stroke-opacity="0.198794158" fill="#FFFFFF" fill-opacity="0.816519475">
                              <path
                                d="M32.6568542,29 L38.3106978,23.3461564 C39.8771021,21.7797521 39.8758057,19.2483887 38.3137085,17.6862915 C36.7547899,16.1273729 34.2176035,16.1255422 32.6538436,17.6893022 L27,23.3431458 L21.3461564,17.6893022 C19.7823965,16.1255422 17.2452101,16.1273729 15.6862915,17.6862915 C14.1241943,19.2483887 14.1228979,21.7797521 15.6893022,23.3461564 L21.3431458,29 L15.6893022,34.6538436 C14.1228979,36.2202479 14.1241943,38.7516113 15.6862915,40.3137085 C17.2452101,41.8726271 19.7823965,41.8744578 21.3461564,40.3106978 L27,34.6568542 L32.6538436,40.3106978 C34.2176035,41.8744578 36.7547899,41.8726271 38.3137085,40.3137085 C39.8758057,38.7516113 39.8771021,36.2202479 38.3106978,34.6538436 L32.6568542,29 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z">
                              </path>
                            </g>
                          </g>
                        </svg>
                      </div>
                      <a data-fancybox data-type="iframe" :href="file.linkview" data-small-btn="true"
                        data-iframe='{"preload":false}'>
                        {{ file.tenfile }}
                      </a>
                    </div>
                  </div>
                </div>
              </div>

              <svg style="cursor: pointer;" @click="clickupload()" class="my-4 mx-auto h-16 w-16 text-gray-400"
                stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                <path
                  d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                  stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
              <div class="flex text-sm text-gray-600">
                <input class="hide" type="file" id="files" ref="files" multiple v-on:change="handleFilesUpload()" />
                </label>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

  </div>
  <!--footer-->
  </div>
  </div>
  </div>


</template>

<script>
export default {
  name: "uploadfile",
  props: {
    tenbang: {
      type: String,
      default: "None",
    },
    id: {
      type: Number,
    },
    truong_id: {
      type: String,
    },
    row: {
      type: Number,
    },
  },
  data() {
    return {
      files: [],
      configfile: [],
      view: false,
      isActivemodal: true,
    };
  },
  watch: {
    id() {
      this.loadfile();
    },
  },
  mounted() {
    const self = this;
    // Lấy dữ liệu từ file config
    axios.get("/config").then(function (response) {
      self.configfile = response.data;
    });
    self.loadfile();
  },
  /*
      Defines the method used by the component
    */

  methods: {
    clickupload() {
      this.$refs.files.click();
    },
    closemodal() {
      this.isActivemodal = true;
    },

    loadfile() {
      const self = this;
      // Lấy dữ liệu
      axios
        .get(
          "/load-file?uuid=" +
          self.truong_id +
          "&tenbang=" +
          self.tenbang +
          "&id=" +
          this.id +
          "&row=" +
          this.row
        )
        .then(function (response) {
          self.files = response.data;
        });
    },
    openModal() {
      this.view = true;
    },
    submitFiles() {
      const self = this;
      /*
          Initialize the form data
        */
      let formData = new FormData();

      /*
          Iteate over any file sent over appending the files
          to the form data.
        */
      //  Lấy dữ liệu file
      for (var i = 0; i < this.files.length; i++) {
        let file = this.files[i];

        formData.append("files[" + i + "]", file);
      }
      // Dữ liệu đính kèm
      formData.append("tenbang", this.tenbang);
      formData.append("row", this.row);
      if (this.id) {
        formData.append("truong_id", this.id);
      } else {
        formData.append("truong_id", this.truong_id);
      }
      /*
          Make the request to the POST /select-files URL
        */
      axios
        .post("/uploads", formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then(function (response) {
          self.loadfile();
          self.$notify({
            title: 'Success',
            message: text,
            type: "Tải file thành công"
          });
          // self.$toasted.success("Tải file thành công");
        })
        .catch(function () {
          self.$notify.error({
            title: 'Tải file thất bại',
            message: text
          });
        });
    },
    /*
        Handles the uploading of files
      */
    //  Sau khi thêm file thì chạy
    handleFilesUpload() {
      const self = this;
      let uploadedFiles = this.$refs.files.files;
      /*
          Adds the uploaded file to the files array
        */
      var check = 0;
      for (var i = 0; i < uploadedFiles.length; i++) {
        // Lấy tên fiel và đuôi file
        // Lấy vị trí dấu chấm
        var fileupload = uploadedFiles[i].name.lastIndexOf(".");
        //Lấy tên file
        var tenfile = uploadedFiles[i].name.slice(0, fileupload);
        // Lấy đuôi file
        var duoi = uploadedFiles[i].name.slice(fileupload + 1);
        // Kiểm tra đuôi file có nằm trong tập tin cofig ko(nằm trong là cho phép pull)
        //
        if (self.configfile.includes(duoi)) {
          self.files.push(uploadedFiles[i]);
          // Thêm dữ liệu vào biến files và gọi đến submit
        } else {
          check = 1;
        }
      }
      if (check == 0) {
        self.submitFiles();
      } else {
        self.$notify.error({
          title: 'Error',
          message: "File không hợp lệ"
        });
        // self.$toasted.error("File không hợp lệ");
      }
    },

    /*
        Removes a select file the user has uploaded
      */
    //  xóa file
    removeFile(key, file) {
      const self = this;
      axios
        .get("/xoa-file?name=" + file.tenfile + "&uuid=" + self.id).then(function (response) {
            self.$notify({
              title: 'Success',
              message: text,
              type: "Xóa thành công"
            });
            self.loadfile();
        }).catch(function () {
            // self.$notify.error({
            //   title: 'Error',
            //   message: "Xóa thất bại!!"
            // });
            self.loadfile();
          
        });
    },
  },
};
</script>

<style>
.flex.text-sm.text-gray-600 {
  display: none;
}

div.file-listing {
  width: 200px;
}

span.remove-file {
  color: red;
  cursor: pointer;
  float: right;
}
</style>

