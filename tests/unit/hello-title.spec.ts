import { shallowMount } from '@vue/test-utils'
import HelloTitle from '@/components/HelloTitle.vue'

describe('HelloTitle.vue', () => {
  it('renders props.msg when passed', () => {
    const msg = 'new message'
    const wrapper = shallowMount(HelloTitle, {
      props: { msg }
    })
    expect(wrapper.text()).toMatch(msg)
  })
})
