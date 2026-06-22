export default function (el) {
  const videos = el.querySelectorAll('video[data-poster-mobile], video[data-src-mobile]')

  if (!videos.length) return

  const isMobile = window.matchMedia('(max-width: 767px)').matches

  if (isMobile) {
    videos.forEach((video) => {
      if (video.dataset.posterMobile) {
        video.poster = video.dataset.posterMobile
      }

      if (video.dataset.srcMobile) {
        const source = video.querySelector('source')
        if (source) {
          source.src = video.dataset.srcMobile
          video.load()
        }
      }
    })
  }
}
