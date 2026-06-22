import { buildRefs, getJSON } from '@/assets/scripts/helpers.js'
import Swiper from 'swiper'
import { A11y, Autoplay, Navigation } from 'swiper/modules'
import 'swiper/css'
import 'swiper/css/a11y'
import 'swiper/css/autoplay'
import 'swiper/css/navigation'

export default function (el) {
  const refs = buildRefs(el)
  const { options } = getJSON(el)

  const config = {
    a11y: true,
    modules: [A11y, Autoplay, Navigation],
    navigation: {
      nextEl: refs.next,
      prevEl: refs.prev
    },
    roundLengths: true,
    slidesPerView: 'auto',
    spaceBetween: 40
  }

  if (options.autoplay && options.autoplaySpeed) {
    config.autoplay = {
      delay: options.autoplaySpeed,
      disableOnInteraction: false
    }
  }

  const swiper = new Swiper(refs.slider, config)

  return () => swiper.destroy()
}
