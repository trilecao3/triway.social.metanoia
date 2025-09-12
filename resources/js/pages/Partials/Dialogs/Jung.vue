<script setup>
import { ref } from "vue";
import { Button } from "@/components/ui/button";
import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogFooter,
  DialogHeader,
  DialogTitle,
  DialogTrigger,
  DialogClose
} from "@/components/ui/dialog";
import { Stories } from "vue-insta-stories";
import { X } from "lucide-vue-next";

const items = ref([
  "images/dinner/1.jpg",
  "images/dinner/2.jpg",
  "images/dinner/3.jpg",
  "images/dinner/4.jpg",
]);
</script>
<template>
  <Dialog>
    <DialogTrigger as-child>
      <Button variant="outline" class="mt-4 bg-transparent text-base font-bold tracking-normal rounded-full px-5 sm:px-7 h-10 sm:h-11 border-black">
        Tìm hiểu vé Jung
      </Button>
    </DialogTrigger>
    <DialogContent class="rounded-xl border-black sm:max-w-3xl p-0 bg-[#15181B] gap-0">
      <DialogHeader class="p-4 sm:px-7 sm:py-5 bg-[#15181B] rounded-t-xl text-white flex flex-row items-center justify-between">
        <DialogTitle class="text-lg sm:text-xl font-bold tracking-tight">Thông tin tiệc tối trước sự kiện</DialogTitle>
        <DialogClose as-child>
          <X class="w-6 h-6 text-white hover:cursor-pointer" />
        </DialogClose>
      </DialogHeader>
      <div class="bg-[#FEFBF6] p-4 sm:px-7 sm:py-7 flex flex-col sm:flex-row gap-y-6 sm:gap-x-14">
        <div class="sm:w-[55%] leading-snug font-medium text-black text-base space-y-2 sm:space-y-3">
          <p>Như 2 mùa trước, vé Jung bao gồm trải nghiệm tiệc tối nhóm nhỏ cùng với Trí trước ngày sự kiện chính.</p>
          <p>Đây là dịp để chúng ta có một không gian riêng tư, với thức ăn, âm nhạc, trò chơi và những câu chuyện sâu lắng để chia sẻ cùng nhau.</p>
          <div class="mt-3 sm:mt-5 space-y-2">
            <div>
              <span class="font-bold">Thời gian:</span> 25/10/2025, 18:00 - 22:00
            </div>
            <div>
              <span class="font-bold">Địa điểm:</span> Hoa Tây Space, 54 Ký Con, Q1
            </div>
            <div>
              <span class="font-bold">Số lượng:</span> Giới hạn 20 vé
            </div>
            <div>
              <span class="font-bold">Dress code:</span> Tiệc tối, trắng - đen
            </div>
          </div>
        </div>
        <div class="sm:w-[45%] relative">
          <Stories
            :stories="items"
            :loop="true"
            :interval="3000"
            class="h-[210px] sm:h-[250px]"
          />
        </div>
      </div>
    </DialogContent>
  </Dialog>
</template>
<style>
.vue-insta-stories {
  border-radius: 0.75rem;
}
.vue-insta-stories .timeline {
  border-top-left-radius: 0.75rem;
  border-top-right-radius: 0.75rem;
  padding-left: 7px;
  padding-right: 7px;
}
.vue-insta-stories .timeline .slice {
  margin: 12px 3px !important;
}
.vue-insta-stories img {
  width: 100% !important;
  height: 100% !important;
  object-fit: cover;
  border-radius: 0.75rem;
}
</style>