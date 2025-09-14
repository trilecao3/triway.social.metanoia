<script setup>
import { Badge } from '@/components/ui/badge';
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
import Jung from './Dialogs/Jung.vue';
import { X } from "lucide-vue-next";
import { onMounted } from 'vue';

const trackTicket = (source) => {
  gtag("event", "Visit_Ticket_Link", {
    source: source
  });
};
</script>
<template>
  <div class="relative w-full flex h-auto w-full items-center justify-center bg-[#FEFBF6] px-5 sm:px-8 lg:px-0">
    <div class="w-full md:max-w-3xl 2xl:max-w-4xl pt-14 sm:pt-28 space-y-14 sm:space-y-20">
      <div class="w-full flex items-center justify-between">
        <div class="text-6xl font-bold leading-12 tracking-tight">
          <img src="/images/Agenda_Tittle.png" alt="Agenda Icon" class="h-16 sm:h-24" />
        </div>
        <div class="text-2xl sm:text-5xl font-semibold leading-7 sm:leading-12 tracking-tight text-right">
          <p>Tháng 10</p>
          <p>/ 2025</p>
        </div>
      </div>

      <div class="w-full space-y-12">
        <div class="flex items-start justify-between gap-x-20">
          <div class="w-1/4">
            <p class="flex flex-col font-bold text-[6rem] leading-none text-blue-700 tracking-tighter">25<span class="-mt-2 text-black text-xl sm:text-2xl font-medium tracking-tight">Tháng 10</span></p>
            <Badge variant="secondary" class="font-bold block mt-3">Vé Jung</Badge>
          </div>
          <div class="w-3/4 flex flex-col sm:flex-row">
            <div class="w-full sm:w-1/2">
              <p class="font-semibold text-2xl sm:text-3xl xl:text-4xl tracking-tight text-right sm:text-left">
                18:00 &mdash; 22:00
              </p>
            </div>
            <div class="w-full sm:w-1/2 text-right text-base sm:text-xl">
              <p>Tiệc tối cùng The Tri Way đêm trước sự kiện chính. Giới hạn 20 người tham dự.</p>
              <Jung />
            </div>
          </div>
        </div>

        <div class="my-2 h-0 border-t-2 border-dashed border-black/20"></div>
        
        <div class="flex items-start justify-between gap-x-20 pt-10">
          <div class="w-1/4">
            <p class="flex flex-col font-bold text-[6rem] leading-none text-red-700 tracking-tighter">26<span class="-mt-2 text-black text-xl sm:text-2xl font-medium tracking-tight">Tháng 10</span></p>
            <div class="mt-3 grid grid-cols-1 gap-2">
              <Badge class="font-bold bg-red-700 text-white">Ngày sự kiện chính</Badge>
              <Badge variant="secondary" class="font-bold">Vé Jung</Badge>
              <Badge variant="secondary" class="font-bold">Vé Plato</Badge>
            </div>
          </div>
          <div class="w-3/4 flex flex-col sm:flex-row">
            <div class="w-full sm:w-1/2">
              <p class="font-semibold text-2xl sm:text-3xl xl:text-4xl tracking-tight text-right sm:text-left">09:30 &mdash; 11:00</p>
            </div>
            <div class="w-full sm:w-1/2 text-right text-xl font-medium w-1/2">
              <p class="font-semibold">Phần I: Góc Nhìn</p>
              <p class="text-base font-light mt-2 leading-snug">Những chia sẻ lớn cho tâm trí từ The Tri Way và diễn giả khách mời + Q&A.</p>

              <Dialog>
                <DialogTrigger as-child>
                  <Button variant="outline" class="mt-4 bg-transparent text-base font-bold tracking-normal rounded-full px-5 sm:px-7 h-10 sm:h-11 border-black">
                    Đọc thêm
                  </Button>
                </DialogTrigger>
                <DialogContent class="rounded-xl border-black sm:max-w-xl p-0 bg-[#15181B] gap-0">
                  <DialogHeader class="p-4 sm:px-7 sm:py-5 bg-[#15181B] rounded-t-xl text-white flex flex-row items-center justify-between">
                    <DialogTitle class="text-lg sm:text-xl font-bold tracking-tight">Phần I: Chia sẻ góc nhìn và Q&A</DialogTitle>
                    <DialogClose as-child>
                      <X class="w-6 h-6 text-white hover:cursor-pointer" />
                    </DialogClose>
                  </DialogHeader>
                  <div class="bg-[#FEFBF6] p-4 sm:p-6 font-medium text-black space-y-5 leading-snug">
                    <p>Tại Metanoia Chương III, Tri Lecao (The Tri Way) sẽ mang đến bài thuyết trình trọng điểm trong năm, chia sẻ một chủ đề tâm huyết cùng cộng đồng thính giả podcast có mặt tại sự kiện. Ngay sau đó, khán giả sẽ có cơ hội tham gia phần Q&amp;A trực tiếp để đối thoại và đặt câu hỏi.</p>
                    <p>Bên cạnh đó, chương trình còn có sự góp mặt của các diễn giả khách mời, mang đến nhiều góc nhìn đa dạng và sâu sắc. Danh sách khách mời sẽ được cập nhật thêm tại page <strong>@triway.social</strong>.</p>
                    <div>
                      <p>Bạn có thể theo dõi @triway.social trên <a href="https://facebook.com/triway.social" target="_blank" class="text-blue-600 underline">Facebook ↗</a> hoặc <a href="https://instagram.com/triway.social" target="_blank" class="text-pink-600 underline">Instagram ↗</a> để nhận update thường xuyên về sự kiện.</p>
                    </div>
                  </div>
                  <DialogFooter class="bg-[#FEFBF6] p-4 sm:p-6 rounded-b-xl">
                    <DialogClose as-child>
                      <Button type="button" variant="secondary">
                        Đóng
                      </Button>
                    </DialogClose>
                  </DialogFooter>
                </DialogContent>
              </Dialog>
            </div>
          </div>
        </div>
        <div class="flex items-center justify-between gap-x-20 -mt-5 sm:-mt-16">
          <div class="w-1/4">
            <p class="font-bold text-6xl text-blue-700 tracking-tighter invisible">26.10</p>
          </div>
          <div class="w-3/4 flex flex-col sm:flex-row">
            <div class="w-full sm:w-1/2">
              <p class="font-semibold text-2xl sm:text-3xl xl:text-4xl tracking-tight text-right sm:text-left">11:30 &mdash; 12:00</p>
            </div>
            <div class="w-full sm:w-1/2 text-right text-xl font-medium w-1/2">
              <p class="font-semibold">Phần II: Trình Diễn</p>
              <p class="text-base font-light mt-2 leading-snug">Những tiết mục biểu diễn từ các nghệ sĩ khách mời.</p>

              <Dialog>
                <DialogTrigger as-child>
                  <Button variant="outline" class="mt-4 bg-transparent text-base font-bold tracking-normal rounded-full px-5 sm:px-7 h-10 sm:h-11 border-black">
                    Đọc thêm
                  </Button>
                </DialogTrigger>
                <DialogContent class="rounded-xl border-black sm:max-w-xl p-0 bg-[#15181B] gap-0">
                  <DialogHeader class="p-4 sm:px-7 sm:py-5 bg-[#15181B] rounded-t-xl text-white flex flex-row items-center justify-between">
                    <DialogTitle class="text-lg sm:text-xl font-bold tracking-tight">Phần II: Trình diễn từ các nghệ sĩ</DialogTitle>
                    <DialogClose as-child>
                      <X class="w-6 h-6 text-white hover:cursor-pointer" />
                    </DialogClose>
                  </DialogHeader>
                  <div class="bg-[#FEFBF6] p-4 sm:p-6 font-medium text-black space-y-5">
                    <p>Hằng năm, Metanoia đem đến chương trình những nghệ sĩ khách mời – cũng là những người bạn trong cộng đồng The Tri Way để tạo ra những nhịp điệu tươi mới.</p>
                    <p>Chủ đề cho các tiết mục năm nay là những tác phẩm mà các nghệ sĩ thấy diễn tả mình <b>chân thực nhất</b>, thay vì là những bài nổi tiếng nhất. Họ cũng sẽ chia sẻ đôi chút về lựa chọn này của mình.</p>
                    <div>
                      <p>Bạn có thể theo dõi @triway.social trên <a href="https://facebook.com/triway.social" target="_blank" class="text-blue-600 underline">Facebook ↗</a> hoặc <a href="https://instagram.com/triway.social" target="_blank" class="text-pink-600 underline">Instagram ↗</a> để nhận update thường xuyên về sự kiện.</p>
                    </div>
                  </div>
                  <DialogFooter class="bg-[#FEFBF6] p-4 sm:p-6 rounded-b-xl">
                    <DialogClose as-child>
                      <Button type="button" variant="secondary">
                        Đóng
                      </Button>
                    </DialogClose>
                  </DialogFooter>
                </DialogContent>
              </Dialog>
            </div>
          </div>
        </div>
        <div class="flex items-center justify-between gap-x-20">
          <div class="w-1/4">
            <p class="font-bold text-6xl text-blue-700 tracking-tighter invisible">26.10</p>
          </div>
          <div class="w-3/4 flex flex-col sm:flex-row">
            <div class="w-full sm:w-1/2">
              <p class="font-semibold text-2xl sm:text-3xl xl:text-4xl tracking-tight text-right sm:text-left">12:00 &mdash; 14:30</p>
            </div>
            <div class="w-full sm:w-1/2 text-right text-xl font-medium w-1/2">
              <p class="font-semibold">Phần III: Kết Nối</p>
              <p class="text-base font-light mt-2 leading-snug">Các trạm sáng tạo và kết nối cộng đồng giữa những người tham dự.</p>
              <Dialog>
                <DialogTrigger as-child>
                  <Button variant="outline" class="mt-4 bg-transparent text-base font-bold tracking-normal rounded-full px-5 sm:px-7 h-10 sm:h-11 border-black">
                    Đọc thêm
                  </Button>
                </DialogTrigger>
                <DialogContent class="rounded-xl border-black sm:max-w-xl p-0 bg-[#15181B] gap-0">
                  <DialogHeader class="p-4 sm:px-7 sm:py-5 bg-[#15181B] rounded-t-xl text-white flex flex-row items-center justify-between">
                    <DialogTitle class="text-lg sm:text-xl font-bold tracking-tight">Phần III: Giao lưu & kết nối</DialogTitle>
                    <DialogClose as-child>
                      <X class="w-6 h-6 text-white hover:cursor-pointer" />
                    </DialogClose>
                  </DialogHeader>
                  <div class="bg-[#FEFBF6] p-4 sm:p-6 font-medium text-black space-y-5">
                    <p>Metanoia Chương III sẽ dành thời lượng lớn nhất để mọi người có dịp kết nối, tìm thêm những người bạn mới.</p>
                    <p>Sẽ có 6 trạm trải nghiệm tất cả: Chân – Thiện – Mỹ – Động – Tĩnh – Soul, hứa hẹn sẽ tạo một không gian gắn kết đầy sáng tạo, với nhiều hoạt động khác nhau để mọi người có thể "đến một mình, về một nhóm".</p>
                    <div>
                      <p>Bạn có thể theo dõi @triway.social trên <a href="https://facebook.com/triway.social" target="_blank" class="text-blue-600 underline">Facebook ↗</a> hoặc <a href="https://instagram.com/triway.social" target="_blank" class="text-pink-600 underline">Instagram ↗</a> để nhận update thường xuyên về sự kiện.</p>
                    </div>
                  </div>
                  <DialogFooter class="bg-[#FEFBF6] p-4 sm:p-6 rounded-b-xl">
                    <DialogClose as-child>
                      <Button type="button" variant="secondary">
                        Đóng
                      </Button>
                    </DialogClose>
                  </DialogFooter>
                </DialogContent>
              </Dialog>
            </div>
          </div>
        </div>

        <div>
          <p class="text-base sm:text-lg"><b>F&B và nạp năng lượng</b>: Sự kiện sẽ có đầy đủ các gian hàng ăn uống F&B, mở xuyên suốt để mọi người có thể dừng chân nghỉ ngơi, tiếp tục lấy lại nhịp độ cho những phần kết nối..</p>
        </div>
      </div>
    </div>
  </div>
  <div class="pt-14 sm:pt-20 relative w-full items-center justify-center bg-[#FEFBF6]">
    <div class="-mb-32 relative z-10 max-w-[320px] sm:max-w-2xl lg:max-w-3xl xl:max-w-4xl mx-auto p-7 sm:p-10 lg:p-14 bg-white/70 backdrop-blur-sm shadow-lg shadow-black/5 rounded-3xl">
      <div class="w-full flex flex-col gap-y-8 sm:gap-y-5 sm:flex-row items-center justify-between">
        <div class="text-6xl font-bold leading-14 tracking-tight">
          <img src="/images/Location_Tittle.png" alt="Agenda Icon" class="h-20 sm:h-28" />
        </div>
        <div class="text-2xl sm:text-4xl lg:text-5xl font-semibold sm:leading-12 tracking-tight text-center sm:text-right">
          <p>SOHO Ballroom</p>
          <p><span class="font-medium tracking-tighter sm:tracking-tight">The Global City</span></p>
        </div>
      </div>

      <div class="mt-3 sm:mt-12 w-full text-center">
        <p class="sm:text-xl xl:text-2xl font-medium">tại <b>đường Đỗ Xuân Hợp, phường An Phú, thành phố Thủ Đức.</b></p>
        <div class="mt-7 sm:mt-11">
          <p>Pin tới vị trí của</p>
          <p class="mt-2 flex items-center gap-x-3 sm:gap-x-4 justify-center">
            <a href="https://www.google.com/maps?q=10.799449920654297,106.77384185791016&z=17&hl=vi" target="_blank" class="font-semibold">📍 SOHO Ballroom</a>
            <a href="https://www.google.com/maps?q=10.799236297607422,106.77223205566406&z=17&hl=vi" target="_blank" class="font-semibold">📍 Bãi đậu xe</a>
          </p>
        </div>
      </div>
    </div>
    <img src="/images/soho-ballroom.png" alt="Soho Ballroom" class="w-full h-[70vh] object-top object-cover" />
    <div class="absolute bottom-0 left-0 w-full h-76 bg-gradient-to-t from-[#FEFBF6] via-[#FEFBF6]/80 to-transparent">
    </div>
  </div>

  <div class="pt-10 pb-20 px-5 sm:px-0 relative w-full items-center justify-center bg-[#FEFBF6]">
    <div class="w-full sm:max-w-3xl md:max-w-4xl mx-auto sm:px-6">
      <h1 class="-mb-8 font-bold tracking-tight text-4xl sm:text-5xl text-center">
        <span
          class="-mb-1 text-5xl sm:text-6xl block font-display text-center rotate-[-4deg] mx-auto font-light text-red-600"
        >
          the ticket
        </span>
        Vé đến Sự Kiện
      </h1>

      <div class="flex items-center justify-center mt-20 sm:mt-10 space-x-5">
        <div class="w-1/2 relative flex flex-col-reverse sm:flex-row sm:min-h-[400px]">
          <div class="relative z-10 sm:mt-40 w-fit ml-3 sm:ml-0 sm:w-[250px] flex flex-col space-y-3 sm:space-y-5">
            <h2 class="text-3xl sm:text-7xl text-blue-700 font-bold tracking-tight">Plato.</h2>
            <div class="grid grid-cols-1 gap-2 sm:flex sm:flex-col sm:space-y-5">
              <div class="sm:mx-auto text-sm sm:text-xl text-blue-700 leading-5 sm:leading-6">
                <p class="font-semibold">Early bird.</p>
                <p>550.000 VND</p>
              </div>
              <div class="text-sm sm:text-xl text-blue-700 leading-5 sm:leading-6">
                <p class="font-semibold">Late bird.</p>
                <p>650.000 VND</p>
              </div>
              <div class="sm:ml-auto text-sm sm:text-xl text-blue-700 leading-5 sm:leading-6">
                <p class="font-semibold">Vé tại cổng.</p>
                <p>750.000 VND</p>
              </div>
            </div>
          </div>

          <img src="/images/Plato_Portrait.png" alt="Plato Ticket" class="sm:absolute right-0 top-0 sm:top-0 w-[90%] h-auto object-contain sm:w-[75%]" />
        </div>
        <div class="w-1/2 relative flex flex-col-reverse sm:flex-row sm:min-h-[570px]">
          <div class="sm:absolute -bottom-5 z-10 flex flex-col gap-y-3 xl:flex-row sm:-ml-0 -mt-4 gap-x-16 justify-between w-full max-w-md">
            <h2 class="text-3xl sm:text-7xl text-red-700 font-bold tracking-tight">Jung.</h2>
            <div class="sm:-mr-6 xl:-mr-28">
              <div class="block sm:hidden text-red-600 text-base sm:text-xl mb-1">
                <p class="font-semibold leading-5">Đặc biệt</p>
                <p class="leading-5">2.500.000 VND</p>
              </div>
              <p class="mt-3 sm:mt-0 leading-snug font-medium text-sm sm:text-lg [text-shadow:_0_0_6px_#FEFBF6,_0_0_12px_#FEFBF6,_0_0_18px_#FEFBF6,_0_0_24px_#FEFBF6,_0_0_36px_#FEFBF6]">
                Giới hạn 20 người.<br>
                Trải nghiệm tiệc tối thân mật trước ngày sự kiện.
              </p>
            </div>
          </div>
          <div class="hidden sm:block z-10 absolute sm:bottom-11 xl:bottom-24 sm:-right-5 xl:-right-16 text-red-600 text-xl">
            <p class="font-semibold">Đặc biệt</p>
            <p>2.500.000 VND</p>
          </div>

          <img src="/images/Jung_Portrait.png" alt="Plato Ticket" class="sm:absolute right-0 top-0 sm:top-40 w-[90%] h-auto object-contain sm:w-[75%]" />
        </div>
      </div>

      <div class="mt-10 sm:mt-20 italic max-w-lg space-y-2 text-sm sm:text-base">
        <p>* Early bird kéo dài từ 12/09 đến 12/10.</p>
        <p>† Vé Jung đã bao gồm vé Plato, thêm tiệc tối đêm trước sự kiện.</p>
        <p>‡ Sinh viên được giảm 20% cho Plato, giới hạn 100 vé và cần thẻ sinh viên. Liên hệ @triway.social để được hỗ trợ.</p>
      </div>

      <div class="mt-14 sm:mt-20 pb-56 sm:pb-76 xl:pb-80 2xl:pb-92">
        <h2 class="text-3xl sm:text-4xl font-bold tracking-tight">Các cách mua vé</h2>
        <div class="mt-7 grid grid-cols-2 sm:grid-cols-4 gap-4 sm:gap-4">
          <a href="https://docs.google.com/forms/d/e/1FAIpQLScfJLhBER-M78BxgKN7l8SKxAQE1DlrFnYXUcNPDpdZKSMzAw/viewform?usp=dialog" target="_blank" class="block px-4 py-3 sm:px-5 sm:py-4 rounded-xl ring-1 ring-gray-900 bg-white shadow-md hover:-translate-y-0.5 transition-transform flex items-center gap-x-6 justify-between"
          @click="trackTicket('Google_Form')">
            <div>
              <p class="text-base xl:text-lg font-semibold">Qua <span class="text-green-700">Google Form</span></p>
              <p class="text-sm sm:text-base mt-0.5 leading-snug">Cho chuyển khoản.</p>
            </div>
          </a>
          <a href="https://vibeji.com/thetriway/event/1002101" target="_blank" class="block px-4 py-3 sm:px-5 sm:py-4 rounded-xl ring-1 ring-gray-900 bg-white shadow-md hover:-translate-y-0.5 transition-transform flex items-center gap-x-6 justify-between"
          @click="trackTicket('Vibeji')">
            <div>
              <p class="text-base xl:text-lg font-semibold">Qua <span class="text-orange-600">Vibeji</span></p>
              <p class="text-sm sm:text-base mt-0.5 leading-snug">Cho thanh toán thẻ.</p>
            </div>
          </a>
          <a href="https://instagram.com/triway.social" target="_blank" class="block px-4 py-3 sm:px-5 sm:py-4 rounded-xl ring-1 ring-gray-900 bg-white shadow-md hover:-translate-y-0.5 transition-transform flex items-center gap-x-6 justify-between"
          @click="trackTicket('Instagram')">
            <div>
              <p class="text-base xl:text-lg font-semibold">Qua <span class="text-pink-600">Instagram</span></p>
              <p class="text-sm sm:text-base mt-0.5 leading-snug">@triway.social hỗ trợ.</p>
            </div>
          </a>
          <a href="https://facebook.com/triway.social" target="_blank" class="block px-4 py-3 sm:px-5 sm:py-4 rounded-xl ring-1 ring-gray-900 bg-white shadow-md hover:-translate-y-0.5 transition-transform flex items-center gap-x-6 justify-between"
          @click="trackTicket('Facebook')">
            <div>
              <p class="text-base xl:text-lg font-semibold">Qua <span class="text-blue-600">Facebook</span></p>
              <p class="text-sm sm:text-base mt-0.5 leading-snug">@triway.social hỗ trợ.</p>
            </div>
          </a>
        </div>

        <p class="mt-8 max-w-2xl italic text-sm sm:text-base"><b>Lưu ý:</b> Chỉ dùng link Google Form được gửi từ các nguồn chính thức của The Tri Way. BTC sẽ không hỗ trợ refund sau khi bạn đã mua vé, bạn cần kiểm tra kĩ ngày giờ và nội dung sự kiện để chác chắn rằng chương trình phù hợp với mình.</p>
      </div>

      <div class="absolute left-0 bottom-0 bg-[url('/images/Crowded.png')] bg-no-repeat sm:bg-repeat bg-top w-full h-[30vh] bg-cover 2xl:bg-contain"></div>
    </div>
  </div>
</template>