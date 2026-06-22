import delegate from 'delegate-event-listener'
import { buildRefs, getJSON } from '@/assets/scripts/helpers.js'

export default function (el) {
  const refs = buildRefs(el)
  const data = getJSON(el)
  let currentPage = 1
  const totalPages = Math.ceil((data.totalReviews || 0) / (data.perPage || 12))

  // Expand/collapse review text
  const expandClickDelegate = delegate('[data-refs="expandBtn"]', toggleExpand)
  el.addEventListener('click', expandClickDelegate)

  function toggleExpand (e) {
    const button = e.target
    const reviewText = button.parentElement.querySelector('[data-ref="reviewText"]')
    const isExpanded = button.getAttribute('aria-expanded') === 'true'

    button.setAttribute('aria-expanded', !isExpanded)
    button.textContent = isExpanded ? 'Read more' : 'Read less'

    if (reviewText) {
      reviewText.setAttribute('aria-expanded', !isExpanded)
    }
  }

  // Pagination
  const prevClickDelegate = delegate('[data-refs="prevBtn"]', goToPrev)
  const nextClickDelegate = delegate('[data-refs="nextBtn"]', goToNext)
  el.addEventListener('click', prevClickDelegate)
  el.addEventListener('click', nextClickDelegate)

  function goToPrev () {
    if (currentPage > 1) {
      showPage(currentPage - 1)
    }
  }

  function goToNext () {
    if (currentPage < totalPages) {
      showPage(currentPage + 1)
    }
  }

  function showPage (page) {
    currentPage = page
    const cards = el.querySelectorAll('[data-page]')

    cards.forEach(function (card) {
      if (parseInt(card.getAttribute('data-page'), 10) === page) {
        card.removeAttribute('hidden')
      } else {
        card.setAttribute('hidden', '')
      }
    })

    // Update button states
    const prevBtn = el.querySelector('[data-refs="prevBtn"]')
    const nextBtn = el.querySelector('[data-refs="nextBtn"]')
    const pageInfo = refs.pageInfo

    if (prevBtn) prevBtn.disabled = (page <= 1)
    if (nextBtn) nextBtn.disabled = (page >= totalPages)
    if (pageInfo) pageInfo.textContent = 'Page ' + page + ' of ' + totalPages

    // Scroll to top of component
    el.scrollIntoView({ behavior: 'smooth', block: 'start' })
  }

  return () => {
    el.removeEventListener('click', expandClickDelegate)
    el.removeEventListener('click', prevClickDelegate)
    el.removeEventListener('click', nextClickDelegate)
  }
}
