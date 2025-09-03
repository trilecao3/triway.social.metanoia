<script setup>
import { Badge } from '@/components/ui/badge';
</script>
<template>
  <section class="relative w-full flex h-auto w-full items-center justify-center bg-[#FEFBF6] px-5 sm:px-8 lg:px-0">
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

      <div class="w-full space-y-10">
        <div class="flex items-center justify-between gap-x-20">
          <div class="w-1/4">
            <p class="flex flex-col font-bold text-[6rem] leading-none text-blue-700 tracking-tighter">25<span class="-mt-3 text-black text-lg font-medium tracking-tight">Tháng 10</span></p>
            <Badge variant="secondary" class="font-bold block mt-3">Vé Jung</Badge>
          </div>
          <div class="w-3/4 flex flex-col sm:flex-row">
            <div class="w-full sm:w-1/2">
              <p class="font-semibold text-2xl sm:text-3xl xl:text-4xl tracking-tight text-right sm:text-left">
                18:00 &mdash; 22:00
              </p>
            </div>
            <div class="w-full sm:w-1/2 text-right text-base sm:text-xl">
              <p>Tiệc tối thân mật cùng The Tri Way. Giới hạn 20 người tham dự.</p>
            </div>
          </div>
        </div>

        <div class="my-2 h-0 border-t-2 border-dashed border-black/20"></div>
        
        <div class="flex items-start justify-between gap-x-20 pt-10">
          <div class="w-1/4">
            <p class="flex flex-col font-bold text-[6rem] leading-none text-red-700 tracking-tighter">26<span class="-mt-3 text-black text-lg font-medium tracking-tight">Tháng 10</span></p>
            <div class="mt-3">
              <Badge class="font-bold mb-2 bg-red-700">Ngày sự kiện chính</Badge>
              <Badge variant="secondary" class="font-bold mr-1">Vé Jung</Badge> + 
              <Badge variant="secondary" class="font-bold mt-1 sm:mt-0 sm:ml-1">Vé Plato</Badge>
            </div>
          </div>
          <div class="w-3/4 flex flex-col sm:flex-row">
            <div class="w-full sm:w-1/2">
              <p class="font-semibold text-2xl sm:text-3xl xl:text-4xl tracking-tight text-right sm:text-left">09:00 &mdash; 10:30</p>
            </div>
            <div class="w-full sm:w-1/2 text-right text-xl font-medium w-1/2">
              <p class="font-semibold">Phần I: Góc Nhìn</p>
              <p class="text-base font-light mt-2 leading-snug">Những chia sẻ lớn cho tâm trí từ The Tri Way và diễn giả khách mời. Q&A cùng người tham dự.</p>
            </div>
          </div>
        </div>
        <div class="flex items-center justify-between gap-x-20 -mt-12 sm:-mt-20">
          <div class="w-1/4">
            <p class="font-bold text-6xl text-blue-700 tracking-tighter invisible">26.10</p>
          </div>
          <div class="w-3/4 flex flex-col sm:flex-row">
            <div class="w-full sm:w-1/2">
              <p class="font-semibold text-2xl sm:text-3xl xl:text-4xl tracking-tight text-right sm:text-left">10:30 &mdash; 11:30</p>
            </div>
            <div class="w-full sm:w-1/2 text-right text-xl font-medium w-1/2">
              <p class="font-semibold">Phần II: Trình Diễn</p>
              <p class="text-base font-light mt-2 leading-snug">Những tiết mục biểu diễn từ các nghệ sĩ khách mời.</p>
            </div>
          </div>
        </div>
        <div class="flex items-center justify-between gap-x-20">
          <div class="w-1/4">
            <p class="font-bold text-6xl text-blue-700 tracking-tighter invisible">26.10</p>
          </div>
          <div class="w-3/4 flex flex-col sm:flex-row">
            <div class="w-full sm:w-1/2">
              <p class="font-semibold text-2xl sm:text-3xl xl:text-4xl tracking-tight text-right sm:text-left">11:30 &mdash; 14:30</p>
            </div>
            <div class="w-full sm:w-1/2 text-right text-xl font-medium w-1/2">
              <p class="font-semibold">Phần III: Kết Nối</p>
              <p class="text-base font-light mt-2 leading-snug">Các trạm sáng tạo và kết nối cộng đồng giữa những người tham dự.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="pt-20 relative w-full items-center justify-center bg-[#FEFBF6]">
    <div class="-mb-32 relative z-10 max-w-[300px] sm:max-w-2xl lg:max-w-3xl xl:max-w-4xl mx-auto p-9 sm:p-10 lg:p-14 bg-white/70 backdrop-blur-sm shadow-lg shadow-black/5 rounded-3xl">
      <div class="w-full flex flex-col gap-y-5 sm:flex-row items-center justify-between">
        <div class="text-6xl font-bold leading-14 tracking-tight">
          <img src="/images/Location_Tittle.png" alt="Agenda Icon" class="h-20 sm:h-28" />
        </div>
        <div class="text-3xl sm:text-4xl lg:text-5xl font-semibold sm:leading-12 tracking-tight text-center sm:text-right">
          <p>SOHO Ballroom</p>
          <p>The Global City.</p>
        </div>
      </div>

      <div class="mt-8 sm:mt-12 w-full text-center">
        <p class="sm:text-xl xl:text-2xl font-medium">tại <b>đường Đỗ Xuân Hợp, phường An Phú, thành phố Thủ Đức.</b></p>
      </div>
    </div>
    <img src="/images/soho-ballroom.png" alt="Soho Ballroom" class="w-full h-[70vh] object-top object-cover" />
    <div class="absolute bottom-0 left-0 w-full h-76 bg-gradient-to-t from-[#FEFBF6] via-[#FEFBF6]/80 to-transparent">
    </div>
  </section>

  <section class="pt-10 pb-20 px-5 sm:px-0 relative w-full items-center justify-center bg-[#FEFBF6]">
    <div class="w-full sm:max-w-3xl md:max-w-4xl mx-auto sm:px-6">
      <h1 class="-mb-8 font-bold tracking-tighter text-5xl text-center">
        <span
          class="-mb-3 text-6xl block font-display text-center rotate-[-4deg] mx-auto font-light text-red-600"
        >
          the ticket
        </span>
        Vé đến Sự Kiện
      </h1>

      <div class="flex items-center justify-center mt-20 sm:mt-10 space-x-5">
        <div class="w-1/2 relative flex flex-col-reverse sm:flex-rpw sm:min-h-[400px]">
          <div class="relative z-10 sm:mt-40 w-[250px] flex flex-col space-y-3 sm:space-y-5">
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
          <div class="sm:absolute -bottom-5 z-10 flex flex-col gap-y-3 xl:flex-row sm:-ml-0 gap-x-16 justify-between w-full max-w-md">
            <h2 class="text-3xl sm:text-7xl text-red-700 font-bold tracking-tight">Jung.</h2>
            <div class="sm:-mr-6 xl:-mr-28">
              <div class="block sm:hidden text-red-600 text-base sm:text-xl mb-1">
                <p class="font-semibold leading-5">Đặc biệt</p>
                <p class="leading-5">2.500.000 VND</p>
              </div>
              <p class="leading-snug font-medium text-sm sm:text-lg [text-shadow:_0_0_6px_#FEFBF6,_0_0_12px_#FEFBF6,_0_0_18px_#FEFBF6,_0_0_24px_#FEFBF6,_0_0_36px_#FEFBF6]">
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

      <div class="mt-10 sm:mt-20 italic max-w-lg space-y-0.5 text-sm sm:text-base">
        <p>* Early bird kéo dài từ 10/09 đến 05/10.</p>
        <p>† Sinh viên được giảm 15% cho Plato, giới hạn 100 vé và cần thẻ sinh viên. Liên hệ @triway.social để được hỗ trợ.</p>
      </div>

      <div class="mt-14 sm:mt-20 pb-56 sm:pb-76 xl:pb-80 2xl:pb-92">
        <h2 class="text-4xl font-bold tracking-tighter">Các cách mua vé</h2>
        <div class="mt-7 grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6">
          <a href="#" class="block p-5 sm:p-6 rounded-xl ring-1 ring-gray-900 bg-white shadow-md hover:-translate-y-0.5 transition-transform">
            <p class="text-lg xl:text-xl font-semibold">Mua qua <span class="text-green-700">Google Form</span></p>
            <p class="mt-1 leading-snug">Dành cho chuyển khoản.</p>
          </a>
          <a href="#" class="block p-5 sm:p-6 rounded-xl ring-1 ring-gray-900 bg-white shadow-md hover:-translate-y-0.5 transition-transform">
            <p class="text-lg xl:text-xl font-semibold">Mua qua <span class="text-orange-600">Vibeji</span></p>
            <p class="mt-1 leading-snug">Hỗ trợ thanh toán thẻ và ví.</p>
          </a>
          <a href="#" class="block p-5 sm:p-6 rounded-xl ring-1 ring-gray-900 bg-white shadow-md hover:-translate-y-0.5 transition-transform">
            <p class="text-lg xl:text-xl font-semibold">Mua qua <span class="text-pink-600">Instagram</span></p>
            <p class="mt-1 leading-snug">@triway.social hỗ trợ mua vé.</p>
          </a>
        </div>

        <p class="mt-8 max-w-2xl italic text-sm sm:text-base">* Lưu ý: BTC không hỗ trợ refund sau khi bạn đã mua vé. Bạn cần kiểm tra kĩ ngày giờ và nội dung sự kiện để chác chắn rằng chương trình phù hợp với mình.</p>
      </div>

      <div class="absolute left-0 bottom-0 bg-[url('/images/Crowded.png')] bg-no-repeat sm:bg-repeat bg-top w-full h-[30vh] bg-cover 2xl:bg-contain"></div>
    </div>
  </section>
</template>