<script>

const listData = []
for (let i = 0; i < 3; i++) {
  listData.push({
    href: 'https://vue.ant.design/',
    title: `ant design vue part ${i}`,
    avatar: 'https://zos.alipayobjects.com/rmsportal/ODTLcjxAfvqbxHnVXCYX.png',
    description: 'Ant Design, a design language for background applications, is refined by Ant UED Team.',
    content: 'We supply a series of design principles, practical patterns and high quality design resources (Sketch and Axure), to help people create their product prototypes beautifully and efficiently.',
  })
}

export default {
    data () {
        return {
            listData,
            actions: [
                { type: 'edit' },
                { type: 'delete'},
            ],
        };
    },
    mounted() {
        console.log('Component mounted.')
    }
}
</script>
