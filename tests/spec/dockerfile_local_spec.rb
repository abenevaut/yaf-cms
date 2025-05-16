# frozen_string_literal: true

require 'docker'
require 'serverspec'
require 'json'

describe 'Dockerfile' do
  before(:all) do # rubocop:disable RSpec/BeforeAfterAll
    ::Docker.options[:read_timeout] = 3000

    build_args = JSON.generate(
      COMPOSER_HASH: 'dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6'
    )

    image = ::Docker::Image.build_from_dir(
      '.',
      'dockerfile' => 'Dockerfile',
      't' => 'abenevaut/yaf-cms:rspec',
      'buildargs': build_args
    )

    set :os, family: :alpine
    set :backend, :docker
    set :docker_image, image.id
  end

  describe command('php --version') do
    it 'confirm php version' do
      expect(subject.stdout).to match(/PHP 8.3/)
    end
  end

  describe command('php -m') do
    it 'confirm php modules' do
      expect(subject.stdout).to match(/yaf/)
    end
  end

  describe command('php -r "phpinfo();"') do
    it 'confirm phpinfo' do
      expect(subject.stdout).to match(/yaf support => enabled/)
      expect(subject.stdout).to match(/yaf.use_namespace => 1 => 1/)
      expect(subject.stdout).to match(/yaf.use_spl_autoload => 1 => 1/)
      expect(subject.stdout).to match(/yaf.environ => local => local/)
    end
  end
end
